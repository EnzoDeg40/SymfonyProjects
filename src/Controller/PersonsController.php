<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Persons;
use Doctrine\Persistence\ManagerRegistry;

class PersonsController extends AbstractController
{
    #[Route('/persons', name: 'app_persons')]
    public function index(): Response
    {
        return $this->render('persons/index.html.twig', [
            'controller_name' => 'PersonsController',
        ]);
    }

    // Afficher la liste des personnes
    #[Route('/persons/list', name: 'show_persons')]
    public function price(ManagerRegistry $doctrine): Response
    {
        //$person = $doctrine->getRepository(Persons::class)->ListAllPersons();
        $person = $doctrine->getRepository(Persons::class)->findAll();

        //$em->getRepository(Contact::class)->findAll();
        /*if (!$person) {
            throw $this->createNotFoundException('Aucune personne trouvé');
        }*/

        //return new Response(var_dump($person));

        return $this->render('base.html.twig', [
            'tableau' => $person
        ]);
    }

    // Inserstion d'une personne dans la base de données
    #[Route('/persons/create', name: 'create_persons')]
    public function createPerson(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        
        $person = new Persons();
        $person->setName ('Degraeve');
        $person->setFirstname('Enzo');
        $person->setPhone('0767635400');

        // tell Doctrine you want to (eventually) save the person (no queries yet)
        $entityManager->persist($person);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response ('Nouvelle personnes créé dans l\'agenda avec l\'id' . $person->getId());
    }

    // Suppression d'une personne dans la base de données
    #[Route('/persons/delete/{id}', name: 'delete_person')]
    public function deletePerson(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $person = $entityManager->getRepository(Persons::class)->find($id);

        if (!$person) {
            throw $this->createNotFoundException(
                'Aucune personne trouvée avec l\'id ' . $id
            );
        }

        $entityManager->remove($person);
        $entityManager->flush();

        return new Response('La personne avec l\'id ' . $id . ' a été supprimé');
    }

    // Afficher une personne dans la base de données a partir d'une vue
    #[Route('/persons/show/{id}', name: 'show_person')]
    public function showPerson(ManagerRegistry $doctrine, int $id): Response
    {
        $person = $doctrine->getRepository(Persons::class)->find($id);

        if (!$person) {
            throw $this->createNotFoundException(
                'Aucune personne trouvée avec l\'id ' . $id
            );
        }

        return $this->render('contact.html.twig', [
            'person' => $person
        ]);
    }
}
