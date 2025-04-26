<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250426054154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, staff_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_60349993D4D57CD (staff_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, staff_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C1765B63D4D57CD (staff_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, staff_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_52520D07D4D57CD (staff_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) DEFAULT NULL, birth_ DATE NOT NULL, number_cin VARCHAR(255) NOT NULL, number_matricule VARCHAR(255) NOT NULL, adresse_exact VARCHAR(255) NOT NULL, work_post VARCHAR(255) NOT NULL, phone_number VARCHAR(14) NOT NULL, situation_family VARCHAR(255) NOT NULL, civility INT NOT NULL, nationality VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, number_child INT NOT NULL, lieu VARCHAR(255) NOT NULL, salary_base DOUBLE PRECISION NOT NULL, date_begin DATE NOT NULL, date_end DATE DEFAULT NULL, hours_per_week INT NOT NULL, day_per_week INT NOT NULL, horary TIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contrat ADD CONSTRAINT FK_60349993D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE departement ADD CONSTRAINT FK_C1765B63D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE responsable ADD CONSTRAINT FK_52520D07D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contrat DROP FOREIGN KEY FK_60349993D4D57CD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE departement DROP FOREIGN KEY FK_C1765B63D4D57CD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07D4D57CD
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contrat
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE departement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE responsable
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE staff
        SQL);
    }
}
