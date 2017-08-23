<?php

namespace XMasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="score")
 */
class Score
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @ORM\ManyToOne(targetEntity="Questionnaire")
     */
    private $questionnaire;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $points
     *
     * @return Score
     */
    public function setScore($points)
    {
        $this->score = $points;

        return $this;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->points;
    }

    /**
     * @return mixed
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }

    /**
     * @param mixed $questionnaire
     */
    public function setQuestionnaire($questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
