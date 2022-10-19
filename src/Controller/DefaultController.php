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

    /**
     * @Route("/ ", name="home")
     */
    public function Home(){
        $tableau = array(
            "1" => array("nom" => "Lebron 1", "prenom" => "James 1", "number" => "0123456789 1"),
            "2" => array("nom" => "Lebron 2", "prenom" => "James 2", "number" => "0123456789 2"),
            "3" => array("nom" => "Lebron 3", "prenom" => "James 3", "number" => "0123456789 3")
        );

        return $this->render('home.html.twig', [
            'tableau' => $tableau
        ]);
    }
    
    
    /*public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }*/
}
