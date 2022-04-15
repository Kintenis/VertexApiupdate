<?php

namespace App\Entity;

use App\Repository\LoyaltyClientsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LoyaltyClientsRepository::class)]
class LoyaltyClients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $Surname;

    #[ORM\Column(type: 'integer')]
    private int $EshopMarketingAgreement;

    #[ORM\Column(type: 'integer')]
    private int $MarketingAgreement;

    #[ORM\Column(type: 'integer')]
    private int $EshopProfilingAgreement;

    #[ORM\Column(type: 'integer')]
    private int $ProfilingAgreement;

    #[ORM\Column(type: 'integer')]
    private int $contactByMobilePhone;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private string $mobile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getEshopMarketingAgreement(): ?int
    {
        return $this->EshopMarketingAgreement;
    }

    public function setEshopMarketingAgreement(int $EshopMarketingAgreement): self
    {
        $this->EshopMarketingAgreement = $EshopMarketingAgreement;

        return $this;
    }

    public function getMarketingAgreement(): ?int
    {
        return $this->MarketingAgreement;
    }

    public function setMarketingAgreement(int $MarketingAgreement): self
    {
        $this->MarketingAgreement = $MarketingAgreement;

        return $this;
    }

    public function getEshopProfilingAgreement(): ?int
    {
        return $this->EshopProfilingAgreement;
    }

    public function setEshopProfilingAgreement(int $EshopProfilingAgreement): self
    {
        $this->EshopProfilingAgreement = $EshopProfilingAgreement;

        return $this;
    }

    public function getProfilingAgreement(): ?int
    {
        return $this->ProfilingAgreement;
    }

    public function setProfilingAgreement(int $ProfilingAgreement): self
    {
        $this->ProfilingAgreement = $ProfilingAgreement;

        return $this;
    }

    public function getContactByMobilePhone(): ?int
    {
        return $this->contactByMobilePhone;
    }

    public function setContactByMobilePhone(int $contactByMobilePhone): self
    {
        $this->contactByMobilePhone = $contactByMobilePhone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }
}
