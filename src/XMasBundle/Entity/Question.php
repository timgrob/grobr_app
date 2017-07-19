<?php

namespace XMasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $question;

    /**
     * @ORM\Column(type="string")
     */
    private $answer1;

    /**
     * @ORM\Column(type="string")
     */
    private $answer2;

    /**
     * @ORM\Column(type="string")
     */
    private $answer3;

    /**
     * @ORM\Column(type="integer")
     */
    private $solution;

    /**
     * @ORM\ManyToOne(targetEntity="Questionnaire", inversedBy="questions")
     */
    private $questionnaire;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     *
     * @return $this
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer1()
    {
        return $this->answer1;
    }

    /**
     * @param string $answer1
     *
     * @return $this
     */
    public function setAnswer1($answer1)
    {
        $this->answer1 = $answer1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer2()
    {
        return $this->answer2;
    }

    /**
     * @param string $answer2
     *
     * @return $this
     */
    public function setAnswer2($answer2)
    {
        $this->answer2 = $answer2;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer3()
    {
        return $this->answer3;
    }

    /**
     * @param string $answer3
     *
     * @return $this
     */
    public function setAnswer3($answer3)
    {
        $this->answer3 = $answer3;
        return $this;
    }

    /**
     * @return string
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * @param string $solution
     *
     * @return $this
     */
    public function setSolution($solution)
    {
        $this->solution = $solution;
        return $this;
    }

    /**
     * @return Questionnaire
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }

    /**
     * @param Questionnaire $questionnaire
     *
     * @return $this
     */
    public function setQuestionnaire($questionnaire)
    {
        $this->questionnaire = $questionnaire;
        return $this;
    }
}
