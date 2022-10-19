<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/test2", name="app_default")
     */
    public function index(){
        return new Response('Hello World');
    }

    /**
     * @Route("/S", name="app_default")
     */
    public function index2(){
        // Return html file
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/blog/{slug}", name="app_default", requirements={"slug"="\d+"})
     */
    public function index3(int $slug){
        return new Response('Hello World '. $slug);
    }

    /*public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }*/
}
