<?php

namespace AppBundle\Stat\CaseEntity\State;

use AppBundle\Entity\CaseEntity;
use AppBundle\Service\CaseService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class ClosedStat
 */
class ClosedStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \AppBundle\Service\CaseService
     */
    protected $caseService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\CaseService $caseService
     */
    public function __construct(CaseService $caseService)
    {
        $this->caseService = $caseService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->caseService->getRepository()->getCount([
                'state' => CaseEntity::STATE_CLOSED
            ]));

        return $datum;
    }
}
