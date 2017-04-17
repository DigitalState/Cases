<?php

namespace Ds\Bundle\CaseBundle\Entity;

use Ds\Component\Entity\Entity\Identifiable;
use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Identitiable;
use Ds\Component\Entity\Entity\Translatable;
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
 * Class CaseEntity
 *
 * @ApiResource(
 *      shortName="Case",
 *      attributes={
 *          "filters"={"ds_case.case.filter"},
 *          "normalization_context"={"groups"={"case_output"}},
 *          "denormalization_context"={"groups"={"case_input"}}
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
     * @Serializer\Groups({"case_output_tier_2"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"case_output_tier_1"})
     * @Assert\Uuid
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_output_tier_2"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_output_tier_2"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_output_tier_2"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @Serializer\Groups({"case_output_tier_2", "case_input_tier_2"})
     * @ORM\Column(name="identity", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $identity;

    /**
     * @var string
     * @Serializer\Groups({"case_output_tier_2", "case_input_tier_2"})
     * @ORM\Column(name="identity_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $identityUuid;

    /**
     * @var string
     * @Serializer\Groups({"case_output_tier_2", "case_input_tier_2"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $owner;

    /**
     * @var string
     * @Serializer\Groups({"case_output_tier_2", "case_input_tier_2"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var array
     * @Serializer\Groups({"case_output_tier_1", "case_input_tier_2"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Translate
     */
    protected $title;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
    }
}
