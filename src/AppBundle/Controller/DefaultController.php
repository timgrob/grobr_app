<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {


    }

    /**
     * @Route("/register", name="register")
     */
    public function regiserAction(Request $request)
    {

    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request, EntityManagerInterface $entityManager, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactFormType::class, $contact);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject($contact->getSubject())
                ->setFrom($contact->getEmail())
                ->setTo($this->container->getParameter('mailer_user'))
                ->setBody(
                    $this->renderView(
                        'AppBundle::emails/contactEmail.html.twig',
                        array('name' => $contact->getFirstName())
                    ),
                    'text/html'
                );

            $mailer->send($message);
            $entityManager->persist($contact);
            $entityManager->flush();

            return new Response('<html><body>The email has been sent successfully!</body></html>');
        }

        return $this->render('AppBundle::emails/contactEmail.html.twig', array(
            'form' => $contactForm->createView(),
            'name' => 'tim'
        ));
    }

    /**
     * @Route("/send")
     */
    public function sendAction()
    {
        $mailer = $this->get('mailer');
        $message = \Swift_Message::newInstance()
            ->setSubject('The Subject for this Message')
            ->setFrom($this->container->getParameter('mailer_user'))
            ->setTo('webpage@timgrob.ch')
            ->setBody('Email from your server')
        ;

        $mailer->send($message);
        return new Response('<html><body>The email has been sent successfully!</body></html>');
    }
}
