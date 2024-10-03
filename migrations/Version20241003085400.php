<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241003085400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE membres_panier (id INT AUTO_INCREMENT NOT NULL, membre_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_C1019FD56A99F74A (membre_id), INDEX IDX_C1019FD5F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membres_panier ADD CONSTRAINT FK_C1019FD56A99F74A FOREIGN KEY (membre_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE membres_panier ADD CONSTRAINT FK_C1019FD5F347EFB FOREIGN KEY (produit_id) REFERENCES produits (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membres_panier DROP FOREIGN KEY FK_C1019FD56A99F74A');
        $this->addSql('ALTER TABLE membres_panier DROP FOREIGN KEY FK_C1019FD5F347EFB');
        $this->addSql('DROP TABLE membres_panier');
    }
}
