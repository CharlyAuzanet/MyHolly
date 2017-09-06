<?php

namespace MyHollyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@MyHolly/index.html.twig');
    }

    public function filActuAction()
    {
        return $this->render('@MyHolly/filActu.html.twig');
    }
}
