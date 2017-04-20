<?php

namespace Ds\Bundle\CaseBundle\Entity;

use Ds\Component\Entity\Entity\Identifiable;
use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Associable;
use Ds\Component\Entity\Entity\Ownable;
use Ds\Component\Entity\Entity\Accessor;
use Knp\DoctrineBehaviors\Model As Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Ds\Component\Entity\Annotation\Translate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class CaseAssociation
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_case.case_association.filter"}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CaseBundle\Repository\CaseAssociationRepository")
 * @ORM\Table(name="ds_case_association")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class CaseAssociation implements Identifiable, Uuidentifiable, Associable, Ownable
{
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Entity;
    use Accessor\EntityUuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;

    /**
     * @var integer
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"case_association_id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"case_association_uuid"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_association_created_at"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_association_updated_at"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_association_deleted_at"})
     */
    protected $deletedAt;

    /**
     * @var \Ds\Bundle\CaseBundle\Entity\CaseEntity
     * @Serializer\Groups({"case_association_case"})
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CaseBundle\Entity\CaseEntity", inversedBy="associations")
     * @ORM\JoinColumn(name="case_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $case; # region accessors

    /**
     * Set case
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseEntity $case
     * @return \Ds\Bundle\CaseBundle\Entity\CaseAssociation
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

    # endregion

    /**
     * @var string
     * @Serializer\Groups({"case_association_entity"})
     * @ORM\Column(name="entity", type="string")
     * @Assert\NotBlank
     */
    protected $entity;

    /**
     * @var string
     * @Serializer\Groups({"case_association_entity_uuid"})
     * @ORM\Column(name="entity_uuid", type="guid")
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $entityUuid;

    /**
     * @var string
     * @Serializer\Groups({"case_association_owner"})
     * @ORM\Column(name="`owner`", type="string")
     * @Assert\NotBlank
     */
    protected $owner;

    /**
     * @var string
     * @Serializer\Groups({"case_association_owner_uuid"})
     * @ORM\Column(name="owner_uuid", type="guid")
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;
}
