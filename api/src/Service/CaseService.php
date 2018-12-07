<?php

namespace App\Service;

use App\Entity\CaseEntity;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class CaseService
 */
final class CaseService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, $entity = CaseEntity::class)
    {
        parent::__construct($manager, $entity);
    }
}
