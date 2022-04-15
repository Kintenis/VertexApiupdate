<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415171643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__loyalty_clients AS SELECT id, name, surname, eshop_marketing_agreement, marketing_agreement, eshop_profiling_agreement, profiling_agreement, contact_by_mobile_phone, email, mobile FROM loyalty_clients');
        $this->addSql('DROP TABLE loyalty_clients');
        $this->addSql('CREATE TABLE loyalty_clients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, eshop_marketing_agreement INTEGER NOT NULL, marketing_agreement INTEGER NOT NULL, eshop_profiling_agreement INTEGER NOT NULL, profiling_agreement INTEGER NOT NULL, contact_by_mobile_phone INTEGER NOT NULL, email VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO loyalty_clients (id, name, surname, eshop_marketing_agreement, marketing_agreement, eshop_profiling_agreement, profiling_agreement, contact_by_mobile_phone, email, mobile) SELECT id, name, surname, eshop_marketing_agreement, marketing_agreement, eshop_profiling_agreement, profiling_agreement, contact_by_mobile_phone, email, mobile FROM __temp__loyalty_clients');
        $this->addSql('DROP TABLE __temp__loyalty_clients');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__loyalty_clients AS SELECT id, name, surname, eshop_marketing_agreement, marketing_agreement, eshop_profiling_agreement, profiling_agreement, contact_by_mobile_phone, email, mobile FROM loyalty_clients');
        $this->addSql('DROP TABLE loyalty_clients');
        $this->addSql('CREATE TABLE loyalty_clients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, eshop_marketing_agreement INTEGER NOT NULL, marketing_agreement INTEGER NOT NULL, eshop_profiling_agreement INTEGER NOT NULL, profiling_agreement INTEGER NOT NULL, contact_by_mobile_phone INTEGER NOT NULL, email VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO loyalty_clients (id, name, surname, eshop_marketing_agreement, marketing_agreement, eshop_profiling_agreement, profiling_agreement, contact_by_mobile_phone, email, mobile) SELECT id, name, surname, eshop_marketing_agreement, marketing_agreement, eshop_profiling_agreement, profiling_agreement, contact_by_mobile_phone, email, mobile FROM __temp__loyalty_clients');
        $this->addSql('DROP TABLE __temp__loyalty_clients');
    }
}
