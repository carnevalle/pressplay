<?php

namespace PressPlay\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PressPlay\CoreBundle\Entity\TimeSheet;
use PressPlay\CoreBundle\Form\TimeSheetType;
use \DateTime;

/**
 * TimeSheet controller.
 *
 * @Route("/timesheet")
 */
class TimeSheetController extends Controller
{
    /**
     * Lists all TimeSheet entities.
     *
     * @Route("/", name="timesheet")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PressPlayCoreBundle:TimeSheet')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a TimeSheet entity.
     *
     * @Route("/{id}/show", name="timesheet_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:TimeSheet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeSheet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new TimeSheet entity.
     *
     * @Route("/new", name="timesheet_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TimeSheet();
        $form   = $this->createForm(new TimeSheetType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new TimeSheet entity.
     *
     * @Route("/create", name="timesheet_create")
     * @Method("post")
     * @Template("PressPlayCoreBundle:TimeSheet:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new TimeSheet();
        $request = $this->getRequest();
        $form    = $this->createForm(new TimeSheetType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('timesheet_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing TimeSheet entity.
     *
     * @Route("/{id}/edit", name="timesheet_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PressPlayCoreBundle:TimeSheet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeSheet entity.');
        }

        $editForm = $this->createForm(new TimeSheetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TimeSheet entity.
     *
     * @Route("/{id}/update", name="timesheet_update")
     * @Method("post")
     * @Template("PressPlayCoreBundle:Default:dashboard.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $timesheet = $em->getRepository('PressPlayCoreBundle:TimeSheet')->find($id);

        if (!$timesheet) {
            throw $this->createNotFoundException('Unable to find TimeSheet entity.');
        }

        // Create an array of the current Tag objects in the database
        $originalTimeTrackings = array();
        foreach ($timesheet->getTimetrackings() as $timetracking){
            $originalTimeTrackings[] = $timetracking;  
        }

        $editForm   = $this->createForm(new TimeSheetType(), $timesheet);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            
            $timetrackings = $timesheet->getTimetrackings();

            // filter $originalEmployees to contain employees no longer present
            foreach ($timetrackings as $timetracking) {
                foreach ($originalTimeTrackings as $key => $toDel) {
                    if ($toDel->getId() === $timetracking->getId()) {
                        unset($originalTimeTrackings[$key]);
                    }
                }
            }

            // We delete the employees that are no longer attached to this month
            foreach ($originalTimeTrackings as $timetracking) {
                $em->remove($timetracking);
            }  

            foreach($timetrackings as $timetracking){
                $timetracking->setTimesheet($timesheet);
            }                        
            
            $em->persist($timesheet);
            $em->flush();

            $this->get('session')->setFlash('confirmation', '');
            
            return $this->redirect($this->generateUrl('dashboard_home', array('date' => $timesheet->getDate()->format("Ymd"))));
        }

        $today = new DateTime();
        
        return array(
            'timesheet'   => $timesheet,
            'today'       => $today,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TimeSheet entity.
     *
     * @Route("/{id}/delete", name="timesheet_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PressPlayCoreBundle:TimeSheet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TimeSheet entity.');
            }
            
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('timesheet'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
