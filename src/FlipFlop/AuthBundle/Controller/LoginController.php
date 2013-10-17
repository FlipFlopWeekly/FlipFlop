<?php

namespace FlipFlop\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends ContainerAware
{
    /**
     * Login action.
     *
     * @return Symfony\Component\HttpFoundation\Response The response.
     */
    public function loginAction()
    {
            $user = null;
            if ($this->container->get('security.context')->getToken()) {
                    $user = $this->container->get('security.context')->getToken()->getUser();
            }
            if (is_object($user)) {
                    return new RedirectResponse($this->container->get('router')->generate('flipflop_site_homepage'));
            }
    
            $request = $this->container->get('request');
            $session = $request->getSession();
    
            // get the error if any (works with forward and redirect -- see below)
            if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                    $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
            } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
                    $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                    $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            } else {
                    $error = '';
            }
    
            if ($error) {
                    // @TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
                    $error = $error->getMessage();
            }
            // last username entered by the user
            $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);
            //$csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
            $csrfToken = $this->container->has('form.csrf_provider')
                         ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
                         : null;
    
            return $this->renderLogin(array(
                            'last_username' => $lastUsername,
                            'error'         => $error,
                            'csrf_token'    => $csrfToken
            ));
    }
    
    protected function renderLogin(array $data)
    {
            return $this->container->get('templating')->renderResponse('FlipFlopAuthBundle:Login:login.html.twig', $data);
    }
    
    /**
     * Check action.
     *
     * @throws \RuntimeException
     */
    public function checkAction()
    {
            throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }
    
    /**
     * Logout action.
     *
     * @throws \RuntimeException
     */
    public function logoutAction()
    {
            throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}