<?php

namespace AppBundle\Service;

use AppBundle\Entity\CaseStatus;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class CaseStatusService
 */
class CaseStatusService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = CaseStatus::class)
    {
        parent::__construct($manager, $entity);
    }
}
