<?php

namespace XMasBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="xmas")
     */
    public function indexAction(Request $request)
    {
        return new Response('<html><body><h1>This is the christmas bundle</h1></body></html>');
    }
}