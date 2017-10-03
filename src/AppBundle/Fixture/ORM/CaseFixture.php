<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\CaseEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

/**
 * Class CaseFixture
 */
abstract class CaseFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $cases = $this->parse($this->getResource());

        foreach ($cases as $case) {
            $entity = new CaseEntity;
            $entity
                ->setUuid($case['uuid'])
                ->setCustomId($case['custom_id'])
                ->setOwner($case['owner'])
                ->setOwnerUuid($case['owner_uuid'])
                ->setIdentity($case['identity'])
                ->setIdentityUuid($case['identity_uuid'])
                ->setTitle($case['title'])
                ->setData($case['data'])
                ->setState($case['state'])
                ->setPriority($case['priority']);
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
