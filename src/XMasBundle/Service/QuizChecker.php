<?php 

namespace XMasBundle\Service;

use XMasBundle\Entity\Question;
use XMasBundle\Entity\Questionnaire;

class QuizChecker
{
	private $questionnaire;
	

	public function __construct(Questionnaire $questionnaire)
	{
		$this->questionnaire = $questionnaire;
	}

	public function run()
	{
	    return array_reduce($this->questionnaire->getQuestions(), function ($p,$q) {
	        if ($q->getGivenAnswer() === $q->getSolution()) {
	            return ++$p;
            }
        }, 0);
	}
}
