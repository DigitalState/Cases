<?php

namespace App\Fixture;

use App\Entity\CaseEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait CaseTrait
 */
trait CaseTrait
{
    use Yaml;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_case_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_case_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $case = new CaseEntity;
            $case
                ->setUuid($object->uuid)
                ->setCustomId($object->custom_id)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setIdentity($object->identity)
                ->setIdentityUuid($object->identity_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setState($object->state)
                ->setPriority($object->priority)
                ->setTenant($object->tenant);
            $manager->persist($case);
            $this->setReference($object->uuid, $case);
        }

        $manager->flush();
    }
}
