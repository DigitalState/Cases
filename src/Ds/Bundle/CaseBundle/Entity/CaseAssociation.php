<?php

namespace Ds\Bundle\CaseBundle\Entity;

use Ds\Component\Entity\Entity\Association;
use Ds\Bundle\CaseBundle\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class CaseAssociation
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_case.case_association.filter"},
 *          "normalization_context"={"groups"={"association_output"}},
 *          "denormalization_context"={"groups"={"association_input"}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CaseBundle\Repository\CaseAssociationRepository")
 * @ORM\Table(name="ds_case_association")
 */
class CaseAssociation extends Association
{
    use Accessor\CaseAccessor;

    /**
     * @var \Ds\Bundle\CaseBundle\Entity\CaseEntity
     * @ApiProperty
     * @Serializer\Groups({"association_output", "association_input"})
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CaseBundle\Entity\CaseEntity", inversedBy="associations")
     * @ORM\JoinColumn(name="case_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $case;
}
