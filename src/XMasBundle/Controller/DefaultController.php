<?php

namespace XMasBundle\Controller;

use AppBundle\Service\MessageGenerator;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use XMasBundle\Entity\Question;
use XMasBundle\Entity\Questionnaire;
use XMasBundle\Form\QuestionnaireType;
use XMasBundle\Form\QuestionType;
use XMasBundle\Service\PictureProvider;
use XMasBundle\Service\QuizChecker;

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
        return $this->render('XMasBundle::index.html.twig');
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profileAction(Request $request)
    {
        return $this->render('XMasBundle::profile.html.twig');
    }

    /**
     * @Route("/memories", name="memories")
     */
    public function memoriesAction()
    {
        $pictureProvider = $this->get('xmas.pictureProvider');
        $pictureFileNames = $pictureProvider->fetchPictureFileNames();

        return $this->render('XMasBundle::memories.html.twig', array(
            'pictureFileNames' => $pictureFileNames
        ));
    }


    /**
     * @Route("/quiz", name="quiz")
     */
    public function quizAction(Request $request)
    {
        $question1 = new Question();
        $question1->setQuestion('hello world 1');
        $question1->setAnswer1('answer 1');
        $question1->setAnswer2('answer 2');
        $question1->setAnswer3('answer 3');

        $question2 = new Question();
        $question2->setQuestion('hello world 2');
        $question2->setAnswer1('1');
        $question2->setAnswer2('2');
        $question2->setAnswer3('3');

        $questionnaire = new Questionnaire();
        $questionnaire->addQuestion($question1);
        $questionnaire->addQuestion($question2);

        $form = $this->createForm(QuestionnaireType::class, $questionnaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $quizChecker = new QuizChecker($form);
            $points = $quizChecker->run();

            return null;
        }

        return $this->render('XMasBundle::quiz.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}