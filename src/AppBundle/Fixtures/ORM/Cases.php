<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\CaseFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Cases
 */
class Cases extends CaseFixture implements OrderedFixtureInterface
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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/cases.yml';
    }
}
