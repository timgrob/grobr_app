<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactFormType;
use AppBundle\Service\MessageGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/home", name="home")
     */
    public function homeAction(Request $request)
    {
        return $this->render('AppBundle::home.html.twig');
    }

    /**
     * @Route("/project", name="project")
     */
    public function projectAction(Request $request)
    {
        return $this->render('AppBundle::project.html.twig');
    }

    /**
     * @Route("/finance", name="finance")
     */
    public function financeAction(Request $request)
    {
        return $this->render('AppBundle::finance.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {
        return $this->render('AppBundle::about.html.twig');
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
    * @Route("/login", name="login")
    */
    public function loginAction(Request $request)
    {
        return $this->redirectToRoute('contact');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

}
