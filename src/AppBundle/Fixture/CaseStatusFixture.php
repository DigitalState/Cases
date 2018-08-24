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

        $statuses = $this->parse($this->getResource());

        foreach ($statuses as $status) {
            $entity = new CaseStatus;
            $entity
                ->setCase($manager->getRepository(CaseEntity::class)->findOneBy(['uuid' => $status->case]))
                ->setUuid($status->uuid)
                ->setOwner($status->owner)
                ->setOwnerUuid($status->owner_uuid)
                ->setIdentity($status->identity)
                ->setIdentityUuid($status->identity_uuid)
                ->setTitle((array) $status->title)
                ->setDescription((array) $status->description)
                ->setData((array) $status->data)
                ->setTenant($status->tenant);
            $manager->persist($entity);
            $manager->flush();
        }
    }
}
