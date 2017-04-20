<?php

namespace Ds\Bundle\CaseBundle\Entity;

use Ds\Component\Entity\Entity\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CaseEntityTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_case_translation")
 */
class CaseTranslation
{
    use Behavior\Translatable\Translation;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Title;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * Returns the translatable entity class name.
     *
     * @return string
     */
    public static function getTranslatableEntityClass()
    {
        return 'CaseEntity';
    }
}
