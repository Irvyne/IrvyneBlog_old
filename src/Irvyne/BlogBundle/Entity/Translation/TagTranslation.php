<?php

namespace Irvyne\BlogBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="tag_translations", indexes={
 *      @ORM\Index(
 *          name="tag_translation_idx",
 *          columns={"locale", "object_class", "foreign_key", "field"}
 *      )
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class TagTranslation extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}