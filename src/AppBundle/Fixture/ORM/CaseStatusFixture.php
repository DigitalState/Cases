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
                ->setIdentity($status['identity'])
                ->setIdentityUuid($status['identity_uuid'])
                ->setTitle($status['title'])
                ->setDescription($status['description'])
                ->setData($status['data']);
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
