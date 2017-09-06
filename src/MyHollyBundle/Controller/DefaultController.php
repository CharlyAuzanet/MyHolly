<?php

namespace MyHollyBundle\Controller;

use MyHollyBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@MyHolly/index.html.twig');
    }

    public function filActuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository(Article::class)->findAll();

        return $this->render('@MyHolly/filActu.html.twig', array(
            'articles' => $articles
        ));
    }
}
