<?php

namespace Ds\Bundle\CaseBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\CaseBundle\Entity\CaseEntity;

/**
 * Class LoadCaseData
 */
class LoadCaseData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $cases = $this->parse(__DIR__.'/../../Resources/data/{server}/cases.yml');

        foreach ($cases as $case) {
            $entity = new CaseEntity;
            $entity
                ->setUuid($case['uuid'])
                ->setOwner($case['owner'])
                ->setOwnerUuid($case['owner_uuid'])
                ->setOwner($case['identity'])
                ->setOwnerUuid($case['identity_uuid'])
                ->setTitle($case['title']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
