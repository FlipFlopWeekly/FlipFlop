<?php

namespace FlipFlop\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use FlipFlop\SiteBundle\Entity\Video;
use FlipFlop\SiteBundle\Form\VideoType;
use FlipFlop\SiteBundle\Form\VideoFilterType;

/**
 * Video controller.
 *
 */
class VideoController extends Controller
{
    /**
     * Lists all Video entities.
     *
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

        return $this->render('FlipFlopSiteBundle:Video:index.html.twig', array(
            'entities' => $entities,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        ));
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new VideoFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('FlipFlopSiteBundle:Video')->createQueryBuilder('e');

        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('VideoControllerFilter');
        }

        // Filter action
        if ($request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('VideoControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('VideoControllerFilter')) {
                $filterData = $session->get('VideoControllerFilter');
                $filterForm = $this->createForm(new VideoFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();

        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('admin_crud_video', array('page' => $page));
        };

        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));

        return array($entities, $pagerHtml);
    }

    /**
     * Creates a new Video entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Video();
        $form = $this->createForm(new VideoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('admin_crud_video_show', array('id' => $entity->getId())));
        }

        return $this->render('FlipFlopSiteBundle:Video:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Video entity.
     *
     */
    public function newAction()
    {
        $entity = new Video();
        $form   = $this->createForm(new VideoType(), $entity);

        return $this->render('FlipFlopSiteBundle:Video:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Video entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlipFlopSiteBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FlipFlopSiteBundle:Video:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Video entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlipFlopSiteBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $editForm = $this->createForm(new VideoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FlipFlopSiteBundle:Video:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Video entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlipFlopSiteBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VideoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('admin_crud_video_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('FlipFlopSiteBundle:Video:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Video entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlipFlopSiteBundle:Video')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Video entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('admin_crud_video'));
    }

    /**
     * Creates a form to delete a Video entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
