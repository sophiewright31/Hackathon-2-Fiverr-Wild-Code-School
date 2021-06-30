<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629085924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, message LONGTEXT NOT NULL, INDEX IDX_FEC530A961220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_counter (id INT AUTO_INCREMENT NOT NULL, message_id INT DEFAULT NULL, sender_id INT DEFAULT NULL, counter INT DEFAULT NULL, INDEX IDX_51AAAE74537A1329 (message_id), INDEX IDX_51AAAE74F624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messaging (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, send_at DATETIME NOT NULL, INDEX IDX_EE15BA61F624B39D (sender_id), INDEX IDX_EE15BA61CD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messaging_content (messaging_id INT NOT NULL, content_id INT NOT NULL, INDEX IDX_D6368B895CA3C610 (messaging_id), INDEX IDX_D6368B8984A0A3ED (content_id), PRIMARY KEY(messaging_id, content_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, is_online TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, image_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6496BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A961220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message_counter ADD CONSTRAINT FK_51AAAE74537A1329 FOREIGN KEY (message_id) REFERENCES content (id)');
        $this->addSql('ALTER TABLE message_counter ADD CONSTRAINT FK_51AAAE74F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messaging ADD CONSTRAINT FK_EE15BA61F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messaging ADD CONSTRAINT FK_EE15BA61CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messaging_content ADD CONSTRAINT FK_D6368B895CA3C610 FOREIGN KEY (messaging_id) REFERENCES messaging (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messaging_content ADD CONSTRAINT FK_D6368B8984A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message_counter DROP FOREIGN KEY FK_51AAAE74537A1329');
        $this->addSql('ALTER TABLE messaging_content DROP FOREIGN KEY FK_D6368B8984A0A3ED');
        $this->addSql('ALTER TABLE messaging_content DROP FOREIGN KEY FK_D6368B895CA3C610');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496BF700BD');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A961220EA6');
        $this->addSql('ALTER TABLE message_counter DROP FOREIGN KEY FK_51AAAE74F624B39D');
        $this->addSql('ALTER TABLE messaging DROP FOREIGN KEY FK_EE15BA61F624B39D');
        $this->addSql('ALTER TABLE messaging DROP FOREIGN KEY FK_EE15BA61CD53EDB6');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE message_counter');
        $this->addSql('DROP TABLE messaging');
        $this->addSql('DROP TABLE messaging_content');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
    }
}
