<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\CaseStatus;

/**
 * Trait Statuses
 */
trait Statuses
{
    /**
     * Add status
     *
     * @param \App\Entity\CaseStatus $status
     * @return \App\Entity\CaseEntity
     */
    public function addStatus(CaseStatus $status)
    {
        if (!$this->statuses->contains($status)) {
            $this->statuses->add($status);
        }

        return $this;
    }

    /**
     * Remove status
     *
     * @param \App\Entity\CaseStatus $status
     * @return \App\Entity\CaseEntity
     */
    public function removeStatus(CaseStatus $status)
    {
        if ($this->statuses->contains($status)) {
            $this->statuses->removeElement($status);
        }

        return $this;
    }

    /**
     * Get statuses
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getStatuses()
    {
        return $this->statuses;
    }
}
