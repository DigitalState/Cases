<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\CaseEntity;

/**
 * Trait CaseAccessor
 */
trait CaseAccessor
{
    /**
     * Set scenario
     *
     * @param \AppBundle\Entity\CaseEntity $case
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
     * @return \AppBundle\Entity\CaseEntity
     */
    public function getCase()
    {
        return $this->case;
    }
}
