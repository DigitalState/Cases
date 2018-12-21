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
