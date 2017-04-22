<?php

namespace Ds\Bundle\CaseBundle\Entity;

use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Identitiable;
use Ds\Component\Model\Type\Translatable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Accessor;
use Knp\DoctrineBehaviors\Model As Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Ds\Component\Model\Annotation\Translate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class CaseEntity
 *
 * @ApiResource(
 *      shortName="Case",
 *      attributes={
 *          "filters"={"ds_case.case.filter"},
 *          "normalization_context"={"groups"={}},
 *          "denormalization_context"={"groups"={}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CaseBundle\Repository\CaseRepository")
 * @ORM\Table(name="ds_case")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class CaseEntity implements Identifiable, Uuidentifiable, Identitiable, Ownable, Translatable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use Accessor\Identity;
    use Accessor\IdentityUuid;
    use Accessor\Translation\Title;
    use Accessor\Translation\Presentation;

    /**
     * @var integer
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"case_id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"case_uuid"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_created_at"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_updated_at"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_deleted_at"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @Serializer\Groups({"case_identity"})
     * @ORM\Column(name="identity", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $identity;

    /**
     * @var string
     * @Serializer\Groups({"case_identity_uuid"})
     * @ORM\Column(name="identity_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $identityUuid;

    /**
     * @var string
     * @Serializer\Groups({"case_owner"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $owner;

    /**
     * @var string
     * @Serializer\Groups({"case_owner_uuid"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var array
     * @Serializer\Groups({"case_title"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Translate
     */
    protected $title;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @Serializer\Groups({"case_associations"})
     * @ORM\OneToMany(targetEntity="Ds\Bundle\CaseBundle\Entity\CaseAssociation", mappedBy="case", cascade={"persist", "remove"})
     */
    protected $associations; # region accessors

    /**
     * Add association
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseAssociation $association
     * @return \Ds\Bundle\CaseBundle\Entity\CaseEntity
     */
    public function addAssociation(CaseAssociation $association)
    {
        if (!$this->associations->contains($association)) {
            $association->setCase($this);
            $this->associations->add($association);
        }

        return $this;
    }

    /**
     * Remove association
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseAssociation $association
     * @return \Ds\Bundle\CaseBundle\Entity\CaseEntity
     */
    public function removeAssociation(CaseAssociation $association)
    {
        if ($this->associations->contains($association)) {
            $this->associations->removeElement($association);
        }

        return $this;
    }

    /**
     * Get associations
     *
     * @return array
     */
    public function getAssociations()
    {
        return $this->associations->toArray();
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
    }

    /**
     * Returns translation entity class name
     *
     * @return string
     */
    public static function getTranslationEntityClass()
    {
        return 'CaseTranslation';
    }
}
