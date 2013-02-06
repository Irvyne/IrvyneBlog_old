<?php

namespace Irvyne\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Irvyne\BlogBundle\Entity\Article;
use Irvyne\BlogBundle\Form\ArticleType;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     * @Template
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('IrvyneBlogBundle:Article')->findAll();

        return array('entities' => $articles);
    }

    /**
     * Finds and displays a Article entity.
     *
     * @ParamConverter("entity", class="IrvyneBlogBundle:Article", options={"slug" = "slug"})
     * @Template
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article->getId());

        return array(
            'entity'      => $article,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @Template
     */
    public function newAction()
    {
        $article = new Article();
        $form   = $this->createForm(new ArticleType(), $article);

        return array(
            'entity' => $article,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Article entity.
     *
     * @Template("IrvyneBlogBundle:Article:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $article  = new Article();
        $form = $this->createForm(new ArticleType(), $article);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('slug' => $article->getSlug())));
        }

        return array(
            'entity' => $article,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Template
     */
    public function editAction(Article $article)
    {
        $editForm = $this->createForm(new ArticleType(), $article);
        $deleteForm = $this->createDeleteForm($article->getId());

        return array(
            'entity'      => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Article entity.
     *
     * @Template("IrvyneBlogBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($article->getId());
        $editForm = $this->createForm(new ArticleType(), $article);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('article_edit', array('id' => $article->getId())));
        }

        return array(
            'entity'      => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction(Request $request, Article $article)
    {
        $form = $this->createDeleteForm($article->getId());
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($article);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
