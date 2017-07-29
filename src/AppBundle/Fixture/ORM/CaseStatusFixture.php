<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\CaseEntity;
use AppBundle\Entity\CaseStatus;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

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
        $statuses = $this->parse($this->getResource());

        foreach ($statuses as $status) {
            $entity = new CaseStatus;
            $entity
                ->setCase($manager->getRepository(CaseEntity::class)->findOneBy(['uuid' => $status['case']]))
                ->setUuid($status['uuid'])
                ->setOwner($status['owner'])
                ->setOwnerUuid($status['owner_uuid'])
                ->setOwner($status['identity'])
                ->setOwnerUuid($status['identity_uuid'])
                ->setTitle($status['title'])
                ->setTitle($status['description']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
