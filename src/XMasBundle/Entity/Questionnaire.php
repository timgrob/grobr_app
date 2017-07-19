<?php

namespace XMasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="questionnaire")
 */
class Questionnaire
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
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="questionnaire")
     */
    private $questions;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param Question[] $questions
     *
     * @return $this
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
        return $this;
    }
}