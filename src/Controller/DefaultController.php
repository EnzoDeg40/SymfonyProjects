<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/hello-world", name="hello_world")
     */
    public function HelloWorld(){
        return new Response('<h1>Hello World</h1>');
    }

    /**
     * @Route("/hello-world/{name} ", name="hello_world_name")
     */
    public function HelloWorldName(string $name){
        return new Response('<h1>Hello World '.$name.'</h1>');
    }
    
    /*public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }*/
}
