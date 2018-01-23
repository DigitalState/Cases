<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Version1_0_0
 */
class Version1_0_0 extends AbstractMigration
{
    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        // Tables
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, `data` BLOB NOT NULL, `time` INTEGER UNSIGNED NOT NULL, lifetime MEDIUMINT NOT NULL) COLLATE utf8_bin, engine = innodb');
        $this->addSql('CREATE TABLE ds_config (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, `value` LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_758C45F4D17F50A6 (uuid), UNIQUE INDEX UNIQ_758C45F44E645A7E (`key`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A76F41DCD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access_permission (id INT AUTO_INCREMENT NOT NULL, access_id INT DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, attributes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_D46DD4D04FEA67CF (access_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_case (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', custom_id VARCHAR(255) NOT NULL, `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', state VARCHAR(255) DEFAULT NULL, priority INT DEFAULT 0 NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7D26BCA4D17F50A6 (uuid), UNIQUE INDEX UNIQ_7D26BCA4614A603A (custom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_case_status (id INT AUTO_INCREMENT NOT NULL, case_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8B0B0409D17F50A6 (uuid), INDEX IDX_8B0B0409CF10D4F5 (case_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_case_status_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', locale VARCHAR(255) NOT NULL, INDEX IDX_12F776492C2AC5D3 (translatable_id), UNIQUE INDEX app_case_status_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_case_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', locale VARCHAR(255) NOT NULL, INDEX IDX_74D34F2D2C2AC5D3 (translatable_id), UNIQUE INDEX app_case_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // Foreign Keys
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id)');
        $this->addSql('ALTER TABLE app_case_status ADD CONSTRAINT FK_8B0B0409CF10D4F5 FOREIGN KEY (case_id) REFERENCES app_case (id)');
        $this->addSql('ALTER TABLE app_case_status_trans ADD CONSTRAINT FK_12F776492C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_case_status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_case_trans ADD CONSTRAINT FK_74D34F2D2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_case (id) ON DELETE CASCADE');

        // Data
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
        $data = Yaml::parse($yml);

        $this->addSql('
            INSERT INTO 
                `ds_config` (`id`, `uuid`, `owner`, `owner_uuid`, `key`, `value`, `enabled`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.username\', \'system@ds\', 1, 1, now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.uuid\', \''.$data['user']['system']['uuid'].'\', 1, 1, now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.roles\', \'ROLE_SYSTEM\', 1, 1, now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity\', \'System\', 1, 1, now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity_uuid\', \''.$data['identity']['system']['uuid'].'\', 1, 1, now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.assets.host\', \''.$data['config']['ds_api.api.assets.host']['value'].'\', 1, 1, now(), now()),
                (7, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.authentication.host\', \''.$data['config']['ds_api.api.authentication.host']['value'].'\', 1, 1, now(), now()),
                (8, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.camunda.host\', \''.$data['config']['ds_api.api.camunda.host']['value'].'\', 1, 1, now(), now()),
                (9, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.cases.host\', \''.$data['config']['ds_api.api.cases.host']['value'].'\', 1, 1, now(), now()),
                (10, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.cms.host\', \''.$data['config']['ds_api.api.cms.host']['value'].'\', 1, 1, now(), now()),
                (11, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.formio.host\', \''.$data['config']['ds_api.api.formio.host']['value'].'\', 1, 1, now(), now()),
                (12, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.identities.host\', \''.$data['config']['ds_api.api.identities.host']['value'].'\', 1, 1, now(), now()),
                (13, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.records.host\', \''.$data['config']['ds_api.api.records.host']['value'].'\', 1, 1, now(), now()),
                (14, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.services.host\', \''.$data['config']['ds_api.api.services.host']['value'].'\', 1, 1, now(), now()),
                (15, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.tasks.host\', \''.$data['config']['ds_api.api.tasks.host']['value'].'\', 1, 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access` (`id`, `uuid`, `owner`, `owner_uuid`, `identity`, `identity_uuid`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'System\', \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Anonymous\', NULL, 1, now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Individual\', NULL, 1, now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Organization\', NULL, 1, now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', NULL, 1, now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access_permission` (`id`, `access_id`, `entity`, `entity_uuid`, `key`, `attributes`)
            VALUES 
                (1, 1, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (2, 1, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (3, 1, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\'),
                (4, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case\', \'["BROWSE","READ"]\'),
                (5, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_uuid\', \'["BROWSE","READ"]\'),
                (6, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_custom_id\', \'["BROWSE","READ"]\'),
                (7, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_created_at\', \'["BROWSE","READ"]\'),
                (8, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_title\', \'["BROWSE","READ"]\'),
                (9, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_data\', \'["BROWSE","READ"]\'),
                (10, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_state\', \'["BROWSE","READ"]\'),
                (11, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_statuses\', \'["BROWSE","READ"]\'),
                (12, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_version\', \'["BROWSE","READ"]\'),
                (13, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status\', \'["BROWSE","READ"]\'),
                (14, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_uuid\', \'["BROWSE","READ"]\'),
                (15, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_created_at\', \'["BROWSE","READ"]\'),
                (16, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_case\', \'["BROWSE","READ"]\'),
                (17, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_title\', \'["BROWSE","READ"]\'),
                (18, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_description\', \'["BROWSE","READ"]\'),
                (19, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_data\', \'["BROWSE","READ"]\'),
                (20, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_version\', \'["BROWSE","READ"]\'),
                (21, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case\', \'["BROWSE","READ"]\'),
                (22, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_uuid\', \'["BROWSE","READ"]\'),
                (23, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_custom_id\', \'["BROWSE","READ"]\'),
                (24, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_created_at\', \'["BROWSE","READ"]\'),
                (25, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_title\', \'["BROWSE","READ"]\'),
                (26, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_data\', \'["BROWSE","READ"]\'),
                (27, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_state\', \'["BROWSE","READ"]\'),
                (28, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_statuses\', \'["BROWSE","READ"]\'),
                (29, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_version\', \'["BROWSE","READ"]\'),
                (30, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status\', \'["BROWSE","READ"]\'),
                (31, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_uuid\', \'["BROWSE","READ"]\'),
                (32, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_created_at\', \'["BROWSE","READ"]\'),
                (33, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_case\', \'["BROWSE","READ"]\'),
                (34, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_title\', \'["BROWSE","READ"]\'),
                (35, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_description\', \'["BROWSE","READ"]\'),
                (36, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_data\', \'["BROWSE","READ"]\'),
                (37, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_version\', \'["BROWSE","READ"]\'),
                (38, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case\', \'["BROWSE","READ"]\'),
                (39, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_uuid\', \'["BROWSE","READ"]\'),
                (40, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_custom_id\', \'["BROWSE","READ"]\'),
                (41, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_created_at\', \'["BROWSE","READ"]\'),
                (42, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_title\', \'["BROWSE","READ"]\'),
                (43, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_data\', \'["BROWSE","READ"]\'),
                (44, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_state\', \'["BROWSE","READ"]\'),
                (45, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_statuses\', \'["BROWSE","READ"]\'),
                (46, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_version\', \'["BROWSE","READ"]\'),
                (47, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status\', \'["BROWSE","READ"]\'),
                (48, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_uuid\', \'["BROWSE","READ"]\'),
                (49, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_created_at\', \'["BROWSE","READ"]\'),
                (50, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_case\', \'["BROWSE","READ"]\'),
                (51, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_title\', \'["BROWSE","READ"]\'),
                (52, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_description\', \'["BROWSE","READ"]\'),
                (53, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_data\', \'["BROWSE","READ"]\'),
                (54, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_version\', \'["BROWSE","READ"]\'),
                (55, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case\', \'["BROWSE","READ"]\'),
                (56, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_property\', \'["BROWSE","READ"]\'),
                (57, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status\', \'["BROWSE","READ"]\'),
                (58, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'case_status_property\', \'["BROWSE","READ"]\'),
                (59, 6, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (60, 6, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (61, 6, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        // Foreign Keys
        $this->addSql('ALTER TABLE ds_access_permission DROP FOREIGN KEY FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_case_status DROP FOREIGN KEY FK_8B0B0409CF10D4F5');
        $this->addSql('ALTER TABLE app_case_trans DROP FOREIGN KEY FK_74D34F2D2C2AC5D3');
        $this->addSql('ALTER TABLE app_case_status_trans DROP FOREIGN KEY FK_12F776492C2AC5D3');

        // Tables
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE app_case');
        $this->addSql('DROP TABLE app_case_status');
        $this->addSql('DROP TABLE app_case_status_trans');
        $this->addSql('DROP TABLE app_case_trans');
        $this->addSql('DROP TABLE ds_session');
    }
}
