<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class CaseFixture
 */
final class CaseFixture extends AbstractFixture implements FixtureInterface, SharedFixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use CaseTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/case.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }
}
