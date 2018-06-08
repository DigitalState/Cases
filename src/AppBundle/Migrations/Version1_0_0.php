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
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Schema
        $this->addSql('CREATE SEQUENCE ds_config_id_seq INCREMENT BY 1 MINVALUE 1 START 9');
        $this->addSql('CREATE SEQUENCE ds_access_id_seq INCREMENT BY 1 MINVALUE 1 START 3');
        $this->addSql('CREATE SEQUENCE ds_access_permission_id_seq INCREMENT BY 1 MINVALUE 1 START 7');
        $this->addSql('CREATE SEQUENCE app_case_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_case_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_case_status_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_case_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ds_config (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, value JSON DEFAULT NULL, enabled BOOLEAN NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4D17F50A6 ON ds_config (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F48A90ABA94E59C462 ON ds_config (key, tenant)');
        $this->addSql('CREATE TABLE ds_access (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, assignee VARCHAR(255) DEFAULT NULL, assignee_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A76F41DCD17F50A6 ON ds_access (uuid)');
        $this->addSql('CREATE TABLE ds_access_permission (id INT NOT NULL, access_id INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, attributes JSON NOT NULL, tenant UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D46DD4D04FEA67CF ON ds_access_permission (access_id)');
        $this->addSql('CREATE TABLE app_case (id INT NOT NULL, uuid UUID NOT NULL, custom_id VARCHAR(255) NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, priority INT DEFAULT 0 NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D26BCA4D17F50A6 ON app_case (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D26BCA4614A603A4E59C462 ON app_case (custom_id, tenant)');
        $this->addSql('CREATE TABLE app_case_status (id INT NOT NULL, case_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B0B0409D17F50A6 ON app_case_status (uuid)');
        $this->addSql('CREATE INDEX IDX_8B0B0409CF10D4F5 ON app_case_status (case_id)');
        $this->addSql('CREATE TABLE app_case_status_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12F776492C2AC5D3 ON app_case_status_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_case_status_trans_unique_translation ON app_case_status_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_case_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_74D34F2D2C2AC5D3 ON app_case_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_case_trans_unique_translation ON app_case_trans (translatable_id, locale)');
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_case_status ADD CONSTRAINT FK_8B0B0409CF10D4F5 FOREIGN KEY (case_id) REFERENCES app_case (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_case_status_trans ADD CONSTRAINT FK_12F776492C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_case_status (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_case_trans ADD CONSTRAINT FK_74D34F2D2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_case (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, data BYTEA NOT NULL, time INTEGER NOT NULL, lifetime INTEGER NOT NULL)');

        // Data
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
        $data = Yaml::parse($yml);

        $this->addSql('
            INSERT INTO 
                ds_config (id, uuid, owner, owner_uuid, key, value, enabled, version, tenant, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.username\', \'"system@system.ds"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.password\', \'"'.$data['user']['system']['password'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.uuid\', \'"'.$data['user']['system']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.roles\', \'[]\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.roles\', \'[]\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.type\', \'"System"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (7, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.uuid\', \'"'.$data['identity']['system']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (8, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.tenant\', \'"'.$data['tenant']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access (id, uuid, owner, owner_uuid, assignee, assignee_uuid, version, tenant, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'System\', \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access_permission (id, access_id, scope, entity, entity_uuid, key, attributes, tenant)
            VALUES 
                (1, 1, \'generic\', NULL, NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\', \''.$data['tenant']['uuid'].'\'),
                (2, 1, \'generic\', NULL, NULL, \'property\', \'["BROWSE","READ","EDIT"]\', \''.$data['tenant']['uuid'].'\'),
                (3, 1, \'generic\', NULL, NULL, \'generic\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\', \''.$data['tenant']['uuid'].'\'),
                (4, 2, \'generic\', NULL, NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\', \''.$data['tenant']['uuid'].'\'),
                (5, 2, \'generic\', NULL, NULL, \'property\', \'["BROWSE","READ","EDIT"]\', \''.$data['tenant']['uuid'].'\'),
                (6, 2, \'generic\', NULL, NULL, \'generic\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\', \''.$data['tenant']['uuid'].'\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Schema
        $this->addSql('ALTER TABLE ds_access_permission DROP CONSTRAINT FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_case_status DROP CONSTRAINT FK_8B0B0409CF10D4F5');
        $this->addSql('ALTER TABLE app_case_trans DROP CONSTRAINT FK_74D34F2D2C2AC5D3');
        $this->addSql('ALTER TABLE app_case_status_trans DROP CONSTRAINT FK_12F776492C2AC5D3');
        $this->addSql('DROP SEQUENCE ds_config_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_permission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_case_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_case_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_case_status_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_case_trans_id_seq CASCADE');
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
