<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class CaseStatusFixture
 */
final class CaseStatusFixture extends AbstractFixture implements FixtureInterface, SharedFixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use CaseStatus;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/case_status.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 21;
    }
}
