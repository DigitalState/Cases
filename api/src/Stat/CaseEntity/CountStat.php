<?php

namespace App\Stat\CaseEntity;

use App\Entity\CaseEntity;
use App\Service\CaseService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
final class CountStat implements Stat
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
            ->setValue($this->caseService->getRepository()->getCount([]));

        return $datum;
    }
}
