<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\CaseEntity;

/**
 * Trait CaseAccessor
 */
trait CaseAccessor
{
    /**
     * Set scenario
     *
     * @param \App\Entity\CaseEntity $case
     * @return object
     */
    public function setCase(CaseEntity $case = null)
    {
        $this->case = $case;

        return $this;
    }

    /**
     * Get case
     *
     * @return \App\Entity\CaseEntity
     */
    public function getCase()
    {
        return $this->case;
    }
}
