<?php

namespace App\Service;

use App\Entity\CaseStatus;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class CaseStatusService
 */
final class CaseStatusService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = CaseStatus::class)
    {
        parent::__construct($manager, $entity);
    }
}
