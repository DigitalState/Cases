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
        $items = $this->parse($this->getResource());

        foreach ($items as $item) {
            $status = new CaseStatus;
            $case = $manager->getRepository(CaseEntity::class)->findOneBy(['uuid' => $item['case']]);
            $status
                ->setCase($case)
                ->setUuid($item['uuid'])
                ->setOwner($item['owner'])
                ->setOwnerUuid($item['owner_uuid'])
                ->setOwner($item['identity'])
                ->setOwnerUuid($item['identity_uuid'])
                ->setTitle($item['title'])
                ->setTitle($item['description']);
            $manager->persist($status);
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
