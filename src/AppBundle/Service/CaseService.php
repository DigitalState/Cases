<?php

namespace AppBundle\Service;

use AppBundle\Entity\CaseEntity;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class CaseService
 */
class CaseService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = CaseEntity::class)
    {
        parent::__construct($manager, $entity);
    }
}
