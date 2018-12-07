<?php

namespace App\Stat\CaseEntity\Count\State;

use App\Entity\CaseEntity;
use App\Service\CaseService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class OpenStat
 */
final class OpenStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \App\Service\CaseService
     */
    private $caseService;

    /**
     * Constructor
     *
     * @param \App\Service\CaseService $caseService
     */
    public function __construct(CaseService $caseService)
    {
        $this->caseService = $caseService;
    }

    /**
     * {@inheritdoc}
     */
    public function get(): Datum
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->caseService->getRepository()->getCount([
                'state' => CaseEntity::STATE_OPEN
            ]));

        return $datum;
    }
}
