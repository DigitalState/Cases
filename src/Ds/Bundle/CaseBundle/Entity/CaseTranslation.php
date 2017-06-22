<?php

namespace Ds\Bundle\CaseBundle\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CaseTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_case_trans")
 */
class CaseTranslation
{
    use Behavior\Translatable\Translation;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Title;

    /**
     * Returns the translatable entity class name.
     *
     * @return string
     */
    public static function getTranslatableEntityClass()
    {
        return 'Ds\Bundle\CaseBundle\Entity\CaseEntity';
    }

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;
}
