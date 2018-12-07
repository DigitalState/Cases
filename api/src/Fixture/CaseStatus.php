<?php

namespace App\Fixture;

use App\Entity\CaseEntity;
use App\Entity\CaseStatus as CaseStatusEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait CaseStatus
 */
trait CaseStatus
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
                $connection->exec('ALTER SEQUENCE app_case_status_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_case_status_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $case = $this->getReference($object->case);

            if (!$case) {
                throw new LogicException('Case "'.$object->case.'" does not exist.');
            }

            $status = new CaseStatusEntity;
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
        }

        $manager->flush();
    }
}
