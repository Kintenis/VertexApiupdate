<?php

declare(strict_types = 1);

namespace App\Command;

use App\Entity\LoyaltyClients;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateByVertexPhoneNumberCommand extends Command
{
    public const MAX_RECORDS_PER_PAGE = 3;

    private ManagerRegistry $managerRegistry;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(
        ManagerRegistry $managerRegistry
    ) {
        $this->managerRegistry = $managerRegistry;

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this
            ->setName('loyalty_rest_api:vertex-update')
            ->setDescription('Updates checkboxes by email and vertex API provided phone number.');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $requestOutput = $this->formatRequestData();

        if(!empty($requestOutput)) {
            $this->updateRecords($requestOutput, $output);
        } else {
            $output->writeln('<error>No data in the vertex API request.</error>');
        }

        return self::SUCCESS;
    }

    private function getRequestData(): array
    {
        $makeRequest = true;
        $requestPage = 1;

        $output = [];

        do {
            $requestOutput = json_decode(file_get_contents('src/Command/Page' . $requestPage . '.json'));

            $requestOutputMerged[] = $requestOutput;

            if(count($requestOutput) === self::MAX_RECORDS_PER_PAGE) {
                $requestPage++;
            } else {
                $makeRequest = false;
            }
        } while ($makeRequest);

        foreach ($requestOutputMerged as $requestOutputElements) {
            foreach ($requestOutputElements as $element) {
                $output[] = $element;
            }
        }

        return $output;
    }

    private function formatRequestData(): array
    {
        $requestData = $this->getRequestData();
        $phoneNumbers = [];

        foreach ($requestData as $element) {
            $phoneNumbers[] = "+" . $element->PhoneNumber;
        }

        return $phoneNumbers;
    }

    /**
     * @param array $requestOutput
     */
    private function updateRecords(array $requestOutput, OutputInterface $output): void
    {
        $entityManager = $this->managerRegistry->getManager();
        $phoneNumbersNotFound = [];

        foreach ($requestOutput as $phoneNumber) {
            $loyaltyData = $entityManager->getRepository(LoyaltyClients::class)->findOneBy(['mobile' => $phoneNumber]);

            if ($loyaltyData) {
                if (empty($loyaltyData->getEmail())) {
                    $loyaltyData->setEshopMarketingAgreement(0);
                    $loyaltyData->setMarketingAgreement(0);
                    $loyaltyData->setEshopProfilingAgreement(0);
                    $loyaltyData->setProfilingAgreement(0);
                    $loyaltyData->setContactByMobilePhone(0);

                    $entityManager->flush();
                } else {
                    $loyaltyData->setContactByMobilePhone(0);

                    $entityManager->flush();
                }
            } else {
                $phoneNumbersNotFound[] = $phoneNumber;
            }
            dump($loyaltyData);
        }

        $output->writeln('<info>Done.</info>');

        if(!empty($phoneNumbersNotFound)) {
            $output->writeln('<comment>Phone numbers that have not been found in the database: ' . json_encode(array_unique($phoneNumbersNotFound)) . '</comment>');
        }
    }
}