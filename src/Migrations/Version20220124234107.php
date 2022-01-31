<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124234107 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE catalog CHANGE load_index load_index VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE job_logs CHANGE moment moment DATETIME NOT NULL, CHANGE project project VARCHAR(50) NOT NULL, CHANGE job job VARCHAR(255) NOT NULL, CHANGE message_type message_type VARCHAR(255) NOT NULL, CHANGE message message VARCHAR(255) NOT NULL, CHANGE duration duration BIGINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE catalog CHANGE load_index load_index INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_logs CHANGE moment moment DATETIME DEFAULT NULL, CHANGE project project VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE job job VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE message_type message_type VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE message message VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE duration duration BIGINT DEFAULT NULL');
    }
}
