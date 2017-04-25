<?php

namespace Ds\Bundle\CaseBundle\Accessor;

use Ds\Bundle\CaseBundle\Entity\CaseEntity;

/**
 * Trait CaseAccessor
 */
trait CaseAccessor
{
    /**
     * Set case
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseEntity $case
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
     * @return \Ds\Bundle\CaseBundle\Entity\CaseEntity
     */
    public function getCase()
    {
        return $this->case;
    }
}
