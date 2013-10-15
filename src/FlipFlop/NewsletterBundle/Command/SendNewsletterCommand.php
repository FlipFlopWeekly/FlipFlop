<?php

namespace FlipFlop\NewsletterBundle\Command;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * SendNewsletterCommand
 *
 * This is the class for the sendNewsletter command
 */
class SendNewsletterCommand extends ContainerAwareCommand
{
    /**
     * Setup command parameters.
     */
    protected function configure()
    {
        $this->setName('flipflop:newsletter:send')
            ->setDescription('Send newsletter to Flipflopiens')
            ->addArgument('easter-egg', InputArgument::OPTIONAL, "Easter egg :)");
    }


    /**
     * The command execution.
     *
     * @param InputInterface  $in  Input
     * @param OutputInterface $out Output
     */
    protected function execute(InputInterface $in, OutputInterface $out)
    {
        // Initialize some variables
        $container = $this->getContainer();
        $em = $container->get('doctrine')->getManager();

        $out->writeln('<info>Call command ' . $this->getName() . '</info>');

        $currentDate = date('Y-m-d');
        $out->writeln("Current date : $currentDate");

//         $newsletter = $this->getContainer()
//             ->get( 'doctrine' )
//             ->getRepository( 'FlipFlopSiteBundle:Newsletter' );

        $parameters = array();
        $parameters['crew_name'] = $container->parameters['crew_name'];

        $message = \Swift_Message::newInstance()
            ->setSubject( 'FlipFlopWeekly' )
            ->setFrom( 'no-reply@logica.com' )
            ->setTo( 'seb.correaud@logica.com' )
            ->setBody( $container->get( 'templating' )->render( 'FlipFlopNewsletterBundle:Default:template.html.twig', array('parameters' => $parameters) ), 'text/html' );

        $container->get( 'mailer' )->send( $message );

        $easter = $in->getArgument( 'easter-egg' );
        $out->writeln("Current params : $easter");

        // Throw mails from spooler
        $spool = $container->get( 'mailer' )->getTransport()->getSpool();
        $transport = $container->get( 'swiftmailer.transport.real' );
        $spool->flushQueue( $transport );
    }
}
