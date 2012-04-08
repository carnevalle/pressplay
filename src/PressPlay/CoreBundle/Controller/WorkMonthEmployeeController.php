<?php

namespace PressPlay\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PressPlay\CoreBundle\Entity\WorkMonthEmployee;
use PressPlay\CoreBundle\Form\WorkMonthEmployeeType;

/**
 * WorkMonthEmployee controller.
 *
 * @Route("/workmonthemployee")
 */
class WorkMonthEmployeeController extends Controller
{
    /**
     * Lists all WorkMonthEmployee entities.
     *
     * @Route("/", name="workmonthemployee")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PressPlayCoreBundle:WorkMonthEmployee')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a WorkMonthEmployee entity.
     *
     * @Route("/{id}/show", name="workmonthemployee_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:WorkMonthEmployee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkMonthEmployee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new WorkMonthEmployee entity.
     *
     * @Route("/new", name="workmonthemployee_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new WorkMonthEmployee();
        $form   = $this->createForm(new WorkMonthEmployeeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new WorkMonthEmployee entity.
     *
     * @Route("/create", name="workmonthemployee_create")
     * @Method("post")
     * @Template("PressPlayCoreBundle:WorkMonthEmployee:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new WorkMonthEmployee();
        $request = $this->getRequest();
        $form    = $this->createForm(new WorkMonthEmployeeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('workmonthemployee_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing WorkMonthEmployee entity.
     *
     * @Route("/{id}/edit", name="workmonthemployee_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:WorkMonthEmployee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkMonthEmployee entity.');
        }

        $editForm = $this->createForm(new WorkMonthEmployeeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing WorkMonthEmployee entity.
     *
     * @Route("/{id}/update", name="workmonthemployee_update")
     * @Method("post")
     * @Template("PressPlayCoreBundle:WorkMonthEmployee:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:WorkMonthEmployee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkMonthEmployee entity.');
        }

        $editForm   = $this->createForm(new WorkMonthEmployeeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('workmonthemployee_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a WorkMonthEmployee entity.
     *
     * @Route("/{id}/delete", name="workmonthemployee_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PressPlayCoreBundle:WorkMonthEmployee')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find WorkMonthEmployee entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('workmonthemployee'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
