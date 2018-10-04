<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\CaseEntity;
use AppBundle\Entity\CaseStatus;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class CaseStatusFixture
 */
abstract class CaseStatusFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_case_status_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_case_status_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $case = $manager->getRepository(CaseEntity::class)->findOneBy(['uuid' => $object->case]);
            $status = new CaseStatus;
            $status
                ->setCase($case)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setIdentity($object->identity)
                ->setIdentityUuid($object->identity_uuid)
                ->setTitle((array) $object->title)
                ->setDescription((array) $object->description)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($status);
            $manager->flush();
        }
    }
}
