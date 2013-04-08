<?php

namespace Irvyne\BlogBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="article_translations", indexes={
 *      @ORM\Index(
 *          name="article_translation_idx",
 *          columns={"locale", "object_class", "foreign_key", "field"}
 *      )
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class ArticleTranslation extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}