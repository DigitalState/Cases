<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\CaseFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class LoadCaseData
 */
class LoadCaseData extends CaseFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{env}/cases.yml';
    }
}
