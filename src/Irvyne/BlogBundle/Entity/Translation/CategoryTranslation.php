<?php

namespace Irvyne\BlogBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="category_translations", indexes={
 *      @ORM\index(
 *          name="category_translation_idx",
 *          columns={"locale", "object_class", "foreign_key", "field"}
 *      )
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class CategoryTranslation extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}