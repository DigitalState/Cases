<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\CaseStatus;

/**
 * Trait Statuses
 */
trait Statuses
{
    /**
     * Add status
     *
     * @param \AppBundle\Entity\CaseStatus $status
     * @return \AppBundle\Entity\CaseEntity
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
     * @param \AppBundle\Entity\CaseStatus $status
     * @return \AppBundle\Entity\CaseEntity
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
