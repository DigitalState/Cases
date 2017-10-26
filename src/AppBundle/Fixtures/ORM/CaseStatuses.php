<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\CaseStatusFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class CaseStatuses
 */
class CaseStatuses extends CaseStatusFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{env}/case_statuses.yml';
    }
}
