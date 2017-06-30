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
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request, EntityManagerInterface $entityManager, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactFormType::class, $contact);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {

            $this->container->get('mailer');
            $message = new \Swift_Message($contact->getSubject());
            $message
                ->setFrom('send@example.com')
                ->setTo($contact->getEmail())
                ->setBody(
                    $this->renderView(
                        'AppBundle::emails/contactEmail.html.twig',
                        array('name' => $contact->getFirstName())
                    ),
                    'text/html'
                );

            $mailer->send($message);
            //$entityManager->persist($contact);
            //$entityManger->flush();
            // $em->persist($task);
            // $em->flush();

            return new Response('test this '. $contact->getEmail());
        }

        return $this->render('AppBundle::contactForm.html.twig', array(
            'form' => $contactForm->createView(),
        ));
    }

    /**
     * @Route("/", name="test")
     */
    public function testAction(Request $request)
    {
        return new Response('<html><body>Hello World</body></html>');
    }
}
