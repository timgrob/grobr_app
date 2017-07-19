<?php

namespace XMasBundle\Controller;

use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use XMasBundle\Entity\Question;
use XMasBundle\Form\QuestionType;

/**
 * @ORM\Entity
 * @ORM\Table(name="default_controller")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="xmas")
     */
    public function indexAction(Request $request)
    {
        return new Response('<html><body><h1>This is the christmas bundle</h1></body></html>');
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profileAction(Request $request)
    {
        return new Response('<html><body><h1>This is your profile</h1></body></html>');
    }


    /**
     * @Route("/quiz", name="quiz")
     */
    public function quizAction(Request $request)
    {
        $question = new Question();
        $question->setQuestion('hello world');
        $question->setAnswer1('1');
        $question->setAnswer2('2');
        $question->setAnswer3('3');

        $form = $this->createForm(QuestionType::class, $question);

        return $this->render('XMasBundle::quiz.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}