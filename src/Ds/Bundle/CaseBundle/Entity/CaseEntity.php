<?php

namespace Ds\Bundle\CaseBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Translatable;
use Ds\Component\Entity\Entity\Ownable;
use Ds\Component\Entity\Entity\Handleable;
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
class CaseEntity implements Uuidentifiable, Translatable, Ownable, Handleable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\Blameable\Blameable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use Accessor\Handler;
    use Accessor\HandlerUuid;
    use Accessor\Translation\Title;
    use Accessor\Translation\Presentation;

    /**
     * @var integer
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"case_output_user"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"case_output"})
     * @Assert\Uuid
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_output_user"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_output_user"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @Serializer\Groups({"case_output_user"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @Serializer\Groups({"case_output_user"})
     */
    protected $createdBy;

    /**
     * @var string
     * @Serializer\Groups({"case_output_user"})
     */
    protected $updatedBy;

    /**
     * @var string
     * @Serializer\Groups({"case_output_user"})
     */
    protected $deletedBy;

    /**
     * @var string
     * @Serializer\Groups({"case_output_user", "case_input_user"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $owner;

    /**
     * @var string
     * @Serializer\Groups({"case_output_user", "case_input_user"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var string
     * @Serializer\Groups({"case_output_user", "case_input_user"})
     * @ORM\Column(name="`handler`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $handler;

    /**
     * @var string
     * @Serializer\Groups({"case_output_user", "case_input_user"})
     * @ORM\Column(name="handler_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $handlerUuid;

    /**
     * @var array
     * @Serializer\Groups({"case_output", "case_input_user"})
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
        $this->presentation = [];
    }
}
