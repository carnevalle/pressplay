<?php

namespace PressPlay\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PressPlay\CoreBundle\Entity\TimeTracking;
use PressPlay\CoreBundle\Form\TimeTrackingType;

/**
 * TimeTracking controller.
 *
 * @Route("/timetracking")
 */
class TimeTrackingController extends Controller
{
    /**
     * Lists all TimeTracking entities.
     *
     * @Route("/", name="timetracking")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PressPlayCoreBundle:TimeTracking')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a TimeTracking entity.
     *
     * @Route("/{id}/show", name="timetracking_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:TimeTracking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeTracking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new TimeTracking entity.
     *
     * @Route("/new", name="timetracking_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TimeTracking();
        $form   = $this->createForm(new TimeTrackingType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new TimeTracking entity.
     *
     * @Route("/create", name="timetracking_create")
     * @Method("post")
     * @Template("PressPlayCoreBundle:TimeTracking:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new TimeTracking();
        $request = $this->getRequest();
        $form    = $this->createForm(new TimeTrackingType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('timetracking_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing TimeTracking entity.
     *
     * @Route("/{id}/edit", name="timetracking_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:TimeTracking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeTracking entity.');
        }

        $editForm = $this->createForm(new TimeTrackingType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TimeTracking entity.
     *
     * @Route("/{id}/update", name="timetracking_update")
     * @Method("post")
     * @Template("PressPlayCoreBundle:TimeTracking:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:TimeTracking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeTracking entity.');
        }

        $editForm   = $this->createForm(new TimeTrackingType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('timetracking_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TimeTracking entity.
     *
     * @Route("/{id}/delete", name="timetracking_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PressPlayCoreBundle:TimeTracking')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TimeTracking entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('timetracking'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
