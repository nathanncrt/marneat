<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120193816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergene (id INT AUTO_INCREMENT NOT NULL, lib_all VARCHAR(100) NOT NULL, desc_all LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_recette (id INT AUTO_INCREMENT NOT NULL, lib_cat_recette VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commenter (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, user_comm_id INT NOT NULL, text_comm LONGTEXT NOT NULL, INDEX IDX_AB751D0A89312FE9 (recette_id), INDEX IDX_AB751D0AB773AA83 (user_comm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenir (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, ingredient_id INT NOT NULL, qte_ingredients DOUBLE PRECISION NOT NULL, INDEX IDX_3C914DFD89312FE9 (recette_id), INDEX IDX_3C914DFD933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, num_etape INT NOT NULL, desc_etape LONGTEXT NOT NULL, img_etape LONGBLOB DEFAULT NULL, INDEX IDX_285F75DD89312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille_ingredient (id INT AUTO_INCREMENT NOT NULL, lib_fam_ing VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_recette (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, jpeg LONGBLOB NOT NULL, INDEX IDX_DCAB344C89312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, unite_mesure_id INT NOT NULL, allergene_id INT NOT NULL, sous_famille_ingredient_id INT NOT NULL, nom_ing VARCHAR(100) NOT NULL, img_ing LONGBLOB DEFAULT NULL, INDEX IDX_6BAF7870C75A06BF (unite_mesure_id), INDEX IDX_6BAF78704646AB2 (allergene_id), INDEX IDX_6BAF7870AD8C0198 (sous_famille_ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noter (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, user_note_id INT NOT NULL, note DOUBLE PRECISION NOT NULL, INDEX IDX_761C961A89312FE9 (recette_id), INDEX IDX_761C961A7EE0165F (user_note_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, sous_categorie_recette_id INT NOT NULL, user_creator_id INT NOT NULL, nom_recette VARCHAR(100) NOT NULL, desc_recette LONGTEXT DEFAULT NULL, tps_prepa TIME NOT NULL, tps_cuisson TIME DEFAULT NULL, tps_repos TIME DEFAULT NULL, date_publi DATETIME NOT NULL, INDEX IDX_49BB6390103865CC (sous_categorie_recette_id), INDEX IDX_49BB6390C645C84A (user_creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_ustensile (recette_id INT NOT NULL, ustensile_id INT NOT NULL, INDEX IDX_613487D589312FE9 (recette_id), INDEX IDX_613487D5B78A4282 (ustensile_id), PRIMARY KEY(recette_id, ustensile_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_section (recette_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_E90BA09589312FE9 (recette_id), INDEX IDX_E90BA095D823E37A (section_id), PRIMARY KEY(recette_id, section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, lib_sec VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie_recette (id INT AUTO_INCREMENT NOT NULL, categorie_recette_id INT NOT NULL, lib_sous_categorie_recette VARCHAR(100) NOT NULL, INDEX IDX_D71D18C517F8E545 (categorie_recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_famille_ingredient (id INT AUTO_INCREMENT NOT NULL, famille_ingredient_id INT NOT NULL, lib_sous_fam_img VARCHAR(100) NOT NULL, INDEX IDX_BC43A7B039EFFA9C (famille_ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, user_stock_id INT NOT NULL, qte_dispo DOUBLE PRECISION NOT NULL, INDEX IDX_4B365660933FE08C (ingredient_id), INDEX IDX_4B365660ED408510 (user_stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unite_mesure (id INT AUTO_INCREMENT NOT NULL, code_um VARCHAR(5) NOT NULL, lib_um VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom_pers VARCHAR(100) NOT NULL, pnom_pers VARCHAR(100) NOT NULL, date_nais DATE NOT NULL, email_pers VARCHAR(100) NOT NULL, tel_pers VARCHAR(10) DEFAULT NULL, cp_pers VARCHAR(5) DEFAULT NULL, adr_pers VARCHAR(100) DEFAULT NULL, ville_pers VARCHAR(100) DEFAULT NULL, avatar LONGBLOB DEFAULT NULL, desc_pers VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_recette (user_id INT NOT NULL, recette_id INT NOT NULL, INDEX IDX_11B67D9AA76ED395 (user_id), INDEX IDX_11B67D9A89312FE9 (recette_id), PRIMARY KEY(user_id, recette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ustensile (id INT AUTO_INCREMENT NOT NULL, nom_us VARCHAR(100) NOT NULL, img_us LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0A89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0AB773AA83 FOREIGN KEY (user_comm_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE image_recette ADD CONSTRAINT FK_DCAB344C89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870C75A06BF FOREIGN KEY (unite_mesure_id) REFERENCES unite_mesure (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78704646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870AD8C0198 FOREIGN KEY (sous_famille_ingredient_id) REFERENCES sous_famille_ingredient (id)');
        $this->addSql('ALTER TABLE noter ADD CONSTRAINT FK_761C961A89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE noter ADD CONSTRAINT FK_761C961A7EE0165F FOREIGN KEY (user_note_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390103865CC FOREIGN KEY (sous_categorie_recette_id) REFERENCES sous_categorie_recette (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390C645C84A FOREIGN KEY (user_creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE recette_ustensile ADD CONSTRAINT FK_613487D589312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_ustensile ADD CONSTRAINT FK_613487D5B78A4282 FOREIGN KEY (ustensile_id) REFERENCES ustensile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_section ADD CONSTRAINT FK_E90BA09589312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_section ADD CONSTRAINT FK_E90BA095D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_categorie_recette ADD CONSTRAINT FK_D71D18C517F8E545 FOREIGN KEY (categorie_recette_id) REFERENCES categorie_recette (id)');
        $this->addSql('ALTER TABLE sous_famille_ingredient ADD CONSTRAINT FK_BC43A7B039EFFA9C FOREIGN KEY (famille_ingredient_id) REFERENCES famille_ingredient (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660ED408510 FOREIGN KEY (user_stock_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_recette ADD CONSTRAINT FK_11B67D9AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_recette ADD CONSTRAINT FK_11B67D9A89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0A89312FE9');
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0AB773AA83');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD89312FE9');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD933FE08C');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD89312FE9');
        $this->addSql('ALTER TABLE image_recette DROP FOREIGN KEY FK_DCAB344C89312FE9');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870C75A06BF');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78704646AB2');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870AD8C0198');
        $this->addSql('ALTER TABLE noter DROP FOREIGN KEY FK_761C961A89312FE9');
        $this->addSql('ALTER TABLE noter DROP FOREIGN KEY FK_761C961A7EE0165F');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390103865CC');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390C645C84A');
        $this->addSql('ALTER TABLE recette_ustensile DROP FOREIGN KEY FK_613487D589312FE9');
        $this->addSql('ALTER TABLE recette_ustensile DROP FOREIGN KEY FK_613487D5B78A4282');
        $this->addSql('ALTER TABLE recette_section DROP FOREIGN KEY FK_E90BA09589312FE9');
        $this->addSql('ALTER TABLE recette_section DROP FOREIGN KEY FK_E90BA095D823E37A');
        $this->addSql('ALTER TABLE sous_categorie_recette DROP FOREIGN KEY FK_D71D18C517F8E545');
        $this->addSql('ALTER TABLE sous_famille_ingredient DROP FOREIGN KEY FK_BC43A7B039EFFA9C');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660933FE08C');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660ED408510');
        $this->addSql('ALTER TABLE user_recette DROP FOREIGN KEY FK_11B67D9AA76ED395');
        $this->addSql('ALTER TABLE user_recette DROP FOREIGN KEY FK_11B67D9A89312FE9');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE categorie_recette');
        $this->addSql('DROP TABLE commenter');
        $this->addSql('DROP TABLE contenir');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE famille_ingredient');
        $this->addSql('DROP TABLE image_recette');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE noter');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_ustensile');
        $this->addSql('DROP TABLE recette_section');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE sous_categorie_recette');
        $this->addSql('DROP TABLE sous_famille_ingredient');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE unite_mesure');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_recette');
        $this->addSql('DROP TABLE ustensile');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
