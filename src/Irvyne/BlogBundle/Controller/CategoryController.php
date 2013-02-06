<?php

namespace Irvyne\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Irvyne\BlogBundle\Entity\Category;
use Irvyne\BlogBundle\Form\CategoryType;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
    /**
     * Lists all Category entities.
     *
     * @Template
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('IrvyneBlogBundle:Category')->findAll();

        return array('entities' => $categories);
    }

    /**
     * Finds and displays a Category entity.
     *
     * @ParamConverter("entity", class="IrvyneBlogBundle:Category", options={"slug" = "slug"})
     * @Template
     */
    public function showAction(Category $category)
    {
        $deleteForm = $this->createDeleteForm($category->getId());

        return array(
            'entity'      => $category,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Category entity.
     *
     * @Template
     */
    public function newAction()
    {
        $category = new Category();
        $form   = $this->createForm(new CategoryType(), $category);

        return array(
            'entity' => $category,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Category entity.
     *
     * @Template("IrvyneBlogBundle:Category:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $category  = new Category();
        $form = $this->createForm(new CategoryType(), $category);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('category_show', array('slug' => $category->getSlug())));
        }

        return array(
            'entity' => $category,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Template
     */
    public function editAction(Category $category)
    {
        $editForm = $this->createForm(new CategoryType(), $category);
        $deleteForm = $this->createDeleteForm($category->getId());

        return array(
            'entity'      => $category,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Category entity.
     *
     * @Template("IrvyneBlogBundle:Category:edit.html.twig")
     */
    public function updateAction(Request $request, Category $category)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($category->getId());
        $editForm = $this->createForm(new CategoryType(), $category);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('category_edit', array('id' => $category->getId())));
        }

        return $this->render('IrvyneBlogBundle:Category:edit.html.twig', array(
            'entity'      => $category,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Category entity.
     *
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category->getId());
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($category);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('category'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
