<?php

namespace App\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Translation\Model\Type\Translation;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CaseStatusTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_case_status_trans")
 */
class CaseStatusTranslation implements Translation
{
    use Behavior\Translatable\Translation;

    use Accessor\Title;
    use Accessor\Description;
    use Accessor\Data;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="data", type="json_array")
     */
    private $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }
}
