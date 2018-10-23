<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ds\Component\Container\Attribute;
use Ramsey\Uuid\Uuid;
use stdClass;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Version0_13_0
 */
class Version0_13_0 extends AbstractMigration implements ContainerAwareInterface
{
    use Attribute\Container;

    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $platform = $this->connection->getDatabasePlatform()->getName();
        $cipherService = $this->container->get('ds_encryption.service.cipher');

        switch ($platform) {
            case 'postgresql':
                // Schema
                $this->addSql('CREATE SEQUENCE ds_config_id_seq INCREMENT BY 1 MINVALUE 1 START 9');
                $this->addSql('CREATE SEQUENCE ds_parameter_id_seq INCREMENT BY 1 MINVALUE 1 START 4');
                $this->addSql('CREATE SEQUENCE ds_metadata_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE ds_metadata_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE ds_access_id_seq INCREMENT BY 1 MINVALUE 1 START 3');
                $this->addSql('CREATE SEQUENCE ds_access_permission_id_seq INCREMENT BY 1 MINVALUE 1 START 7');
                $this->addSql('CREATE SEQUENCE ds_tenant_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
                $this->addSql('CREATE SEQUENCE app_case_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_case_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_case_status_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_case_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE TABLE ds_config (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, value TEXT DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4D17F50A6 ON ds_config (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F48A90ABA94E59C462 ON ds_config (key, tenant)');
                $this->addSql('CREATE TABLE ds_parameter (id INT NOT NULL, "key" VARCHAR(255) NOT NULL, value TEXT DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_B3C0FD91F48571EB ON ds_parameter ("key")');
                $this->addSql('CREATE TABLE ds_metadata (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_11290F17D17F50A6 ON ds_metadata (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_11290F17989D9B624E59C462 ON ds_metadata (slug, tenant)');
                $this->addSql('CREATE TABLE ds_metadata_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_A6447E202C2AC5D3 ON ds_metadata_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX ds_metadata_trans_unique_translation ON ds_metadata_trans (translatable_id, locale)');
                $this->addSql('CREATE TABLE ds_access (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, assignee VARCHAR(255) DEFAULT NULL, assignee_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_A76F41DCD17F50A6 ON ds_access (uuid)');
                $this->addSql('CREATE TABLE ds_access_permission (id INT NOT NULL, access_id INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, attributes JSON NOT NULL, tenant UUID NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_D46DD4D04FEA67CF ON ds_access_permission (access_id)');
                $this->addSql('CREATE TABLE ds_tenant (id INT NOT NULL, uuid UUID NOT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_EF5FAEEAD17F50A6 ON ds_tenant (uuid)');
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
                $this->addSql('ALTER TABLE ds_metadata_trans ADD CONSTRAINT FK_A6447E202C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ds_metadata (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_case_status ADD CONSTRAINT FK_8B0B0409CF10D4F5 FOREIGN KEY (case_id) REFERENCES app_case (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_case_status_trans ADD CONSTRAINT FK_12F776492C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_case_status (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_case_trans ADD CONSTRAINT FK_74D34F2D2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_case (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, data BYTEA NOT NULL, time INTEGER NOT NULL, lifetime INTEGER NOT NULL)');

                // Data
                $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
                $data = Yaml::parse($yml);
                $i = 0;
                $parameters = [
                    [
                        'key' => 'ds_system.user.username',
                        'value' => serialize($data['system']['username'])
                    ],
                    [
                        'key' => 'ds_system.user.password',
                        'value' => $cipherService->encrypt(serialize($data['system']['password']))
                    ],
                    [
                        'key' => 'ds_tenant.tenant.default',
                        'value' => serialize($data['tenant']['uuid'])
                    ]
                ];

                foreach ($parameters as $parameter) {
                    $this->addSql(sprintf(
                        'INSERT INTO ds_parameter (id, key, value) VALUES (%d, %s, %s);',
                        ++$i,
                        $this->connection->quote($parameter['key']),
                        $this->connection->quote($parameter['value'])
                    ));
                }

                $i = 0;
                $tenants = [
                    [
                        'uuid' => $data['tenant']['uuid'],
                        'data' => '"'.$cipherService->encrypt(new stdClass).'"'
                    ]
                ];

                foreach ($tenants as $tenant) {
                    $this->addSql(sprintf(
                        'INSERT INTO ds_tenant (id, uuid, data, created_at, updated_at) VALUES (%d, %s, %s, %s, %s);',
                        ++$i,
                        $this->connection->quote($tenant['uuid']),
                        $this->connection->quote($tenant['data']),
                        'now()',
                        'now()'
                    ));
                }

                $i = 0;
                $configs = [
                    [
                        'key' => 'ds_api.user.username',
                        'value' => serialize($data['user']['system']['username'])
                    ],
                    [
                        'key' => 'ds_api.user.password',
                        'value' => $cipherService->encrypt(serialize($data['user']['system']['password']))
                    ],
                    [
                        'key' => 'ds_api.user.uuid',
                        'value' => serialize($data['user']['system']['uuid'])
                    ],
                    [
                        'key' => 'ds_api.user.roles',
                        'value' => serialize([])
                    ],
                    [
                        'key' => 'ds_api.user.identity.roles',
                        'value' => serialize([])
                    ],
                    [
                        'key' => 'ds_api.user.identity.type',
                        'value' => serialize('System')
                    ],
                    [
                        'key' => 'ds_api.user.identity.uuid',
                        'value' => serialize($data['identity']['system']['uuid'])
                    ],
                    [
                        'key' => 'ds_api.user.tenant',
                        'value' => serialize($data['tenant']['uuid'])
                    ]
                ];

                foreach ($configs as $config) {
                    $this->addSql(sprintf(
                        'INSERT INTO ds_config (id, uuid, owner, owner_uuid, key, value, version, tenant, created_at, updated_at) VALUES (%d, %s, %s, %s, %s, %s, %d, %s, %s, %s);',
                        ++$i,
                        $this->connection->quote(Uuid::uuid4()->toString()),
                        $this->connection->quote('BusinessUnit'),
                        $this->connection->quote($data['business_unit']['administration']['uuid']),
                        $this->connection->quote($config['key']),
                        $this->connection->quote($config['value']),
                        1,
                        $this->connection->quote($data['tenant']['uuid']),
                        'now()',
                        'now()'
                    ));
                }

                $i = 0;
                $j = 0;
                $accesses = [
                    [
                        'owner' => 'System',
                        'owner_uuid' => $data['identity']['system']['uuid'],
                        'assignee' => 'System',
                        'assignee_uuid' => $data['identity']['system']['uuid'],
                        'permissions' => [
                            [
                                'key' => 'entity',
                                'attributes' => '["BROWSE","READ","EDIT","ADD","DELETE"]'
                            ],
                            [
                                'key' => 'property',
                                'attributes' => '["BROWSE","READ","EDIT"]'
                            ],
                            [
                                'key' => 'generic',
                                'attributes' => '["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]'
                            ]
                        ]
                    ],
                    [
                        'owner' => 'BusinessUnit',
                        'owner_uuid' => $data['business_unit']['administration']['uuid'],
                        'assignee' => 'Staff',
                        'assignee_uuid' => $data['identity']['admin']['uuid'],
                        'permissions' => [
                            [
                                'key' => 'entity',
                                'attributes' => '["BROWSE","READ","EDIT","ADD","DELETE"]'
                            ],
                            [
                                'key' => 'property',
                                'attributes' => '["BROWSE","READ","EDIT"]'
                            ],
                            [
                                'key' => 'generic',
                                'attributes' => '["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]'
                            ]
                        ]
                    ]
                ];

                foreach ($accesses as $access) {
                    $this->addSql(sprintf(
                        'INSERT INTO ds_access (id, uuid, owner, owner_uuid, assignee, assignee_uuid, version, tenant, created_at, updated_at) VALUES (%d, %s, %s, %s, %s, %s, %d, %s, %s, %s);',
                        ++$i,
                        $this->connection->quote(Uuid::uuid4()->toString()),
                        $this->connection->quote($access['owner']),
                        $this->connection->quote($access['owner_uuid']),
                        $this->connection->quote($access['assignee']),
                        $this->connection->quote($access['assignee_uuid']),
                        1,
                        $this->connection->quote($data['tenant']['uuid']),
                        'now()',
                        'now()'
                    ));

                    foreach ($access['permissions'] as $permission) {
                        $this->addSql(sprintf(
                            'INSERT INTO ds_access_permission (id, access_id, scope, entity, entity_uuid, key, attributes, tenant) VALUES (%d, %d, %s, %s, %s, %s, %s, %s);',
                            ++$j,
                            $i,
                            $this->connection->quote('generic'),
                            'NULL',
                            'NULL',
                            $this->connection->quote($permission['key']),
                            $this->connection->quote($permission['attributes']),
                            $this->connection->quote($data['tenant']['uuid'])
                        ));
                    }
                }

                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$platform.'".');
                break;
        }
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $platform = $this->connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                // Schema
                $this->addSql('ALTER TABLE ds_metadata_trans DROP CONSTRAINT FK_A6447E202C2AC5D3');
                $this->addSql('ALTER TABLE ds_access_permission DROP CONSTRAINT FK_D46DD4D04FEA67CF');
                $this->addSql('ALTER TABLE app_case_status DROP CONSTRAINT FK_8B0B0409CF10D4F5');
                $this->addSql('ALTER TABLE app_case_trans DROP CONSTRAINT FK_74D34F2D2C2AC5D3');
                $this->addSql('ALTER TABLE app_case_status_trans DROP CONSTRAINT FK_12F776492C2AC5D3');
                $this->addSql('DROP SEQUENCE ds_config_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE ds_parameter_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE ds_metadata_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE ds_metadata_trans_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE ds_access_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE ds_access_permission_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE ds_tenant_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_case_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_case_status_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_case_status_trans_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_case_trans_id_seq CASCADE');
                $this->addSql('DROP TABLE ds_config');
                $this->addSql('DROP TABLE ds_parameter');
                $this->addSql('DROP TABLE ds_metadata');
                $this->addSql('DROP TABLE ds_metadata_trans');
                $this->addSql('DROP TABLE ds_access');
                $this->addSql('DROP TABLE ds_access_permission');
                $this->addSql('DROP TABLE ds_tenant');
                $this->addSql('DROP TABLE app_case');
                $this->addSql('DROP TABLE app_case_status');
                $this->addSql('DROP TABLE app_case_status_trans');
                $this->addSql('DROP TABLE app_case_trans');
                $this->addSql('DROP TABLE ds_session');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$platform.'".');
                break;
        }
    }
}
