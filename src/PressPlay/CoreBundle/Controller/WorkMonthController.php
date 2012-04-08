<?php

namespace PressPlay\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PressPlay\CoreBundle\Entity\WorkMonth;
use PressPlay\CoreBundle\Form\WorkMonthType;
use PressPlay\CoreBundle\Entity\WorkMonthEmployee;
use PressPlay\CoreBundle\Form\WorkMonthEmployeeType;
use \DateTime;

/**
 * WorkMonth controller.
 *
 * @Route("/admin/workmonth")
 */
class WorkMonthController extends Controller
{
    /**
     * Lists all WorkMonth entities.
     *
     * @Route("/", name="admin_workmonth")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PressPlayCoreBundle:WorkMonth')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a WorkMonth entity.
     *
     * @Route("/{id}/show", name="admin_workmonth_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:WorkMonth')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkMonth entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new WorkMonth entity.
     *
     * @Route("/new", name="admin_workmonth_new")
     * @Template()
     */
    public function newAction()
    {
        $workmonth = new WorkMonth();
        $form   = $this->createForm(new WorkMonthType(), $workmonth);   

        return array(
            'entity' => $workmonth,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new WorkMonth entity.
     *
     * @Route("/create", name="admin_workmonth_create")
     * @Method("post")
     * @Template("PressPlayCoreBundle:WorkMonth:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new WorkMonth();
        $request = $this->getRequest();
        $form    = $this->createForm(new WorkMonthType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_workmonth_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing WorkMonth entity.
     *
     * @Route("/{id}/edit", name="admin_workmonth_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $workmonth = $em->getRepository('PressPlayCoreBundle:WorkMonth')->find($id);

        if (!$workmonth) {
            throw $this->createNotFoundException('Unable to find WorkMonth entity.');
        }            
        
        $editForm = $this->createForm(new WorkMonthType(), $workmonth);
        $deleteForm = $this->createDeleteForm($id);

        $employee = new WorkMonthEmployee();
        $employee->setWorkmonth($workmonth);
        $add_employee_form   = $this->createForm(new WorkMonthEmployeeType(), $employee);        
        
        return array(
            'entity'      => $workmonth,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'add_employee_form' => $add_employee_form->createView(),            
        );
    }

    /**
     * Edits an existing WorkMonth entity.
     *
     * @Route("/{id}/update", name="admin_workmonth_update")
     * @Method("post")
     * @Template("PressPlayCoreBundle:WorkMonth:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:WorkMonth')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkMonth entity.');
        }

        $editForm   = $this->createForm(new WorkMonthType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_workmonth_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a WorkMonth entity.
     *
     * @Route("/{id}/delete", name="admin_workmonth_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PressPlayCoreBundle:WorkMonth')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find WorkMonth entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_workmonth'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
