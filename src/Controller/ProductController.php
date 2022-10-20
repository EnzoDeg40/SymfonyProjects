<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;

class ProductController extends AbstractController
{
    #[Route('/product/create', name: 'create_product')]
    public function createProduct(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        
        $product = new Product();
        $product->setName ('Keyboard');
        $product->setPrice(random_int(100, 1000));
        $product->setDescription('Ergonomicandstylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response ('Saved new product with id '. $product->getId());
    }

    #[Route('/product/update/{id}', name: 'update_product')]   
    public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();

        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $product->setName('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('product_show',[
            'id' => $product->getId()
        ]);

    }

    #[Route('/product/remove/{id}', name: 'remove_product')]
    public function remove(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('product_list');
    }

    #[Route('/product/show/{id}', name: 'product_show')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        return new Response($product->getId() . ' ' . $product->getName() . ' ' . $product->getPrice() . ' ' . $product->getDescription());
    }

    #[Route('/product/list', name: 'product_list')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();

        if (!$products) {
            throw $this->createNotFoundException('No products found');
        }

        return new Response(count($products));

        /*return $this->render('product/list.html.twig', [
            'products' => $products
        ]);*/
    }

    #[Route('/product/price/{price}', name: 'product_price')]
    public function price(ManagerRegistry $doctrine, int $price): Response
    {

        return new Response('Price: ' . $price);

        $products = $doctrine->getRepository(Product::class)->findAllGreaterThanPrice($price);

        if (!$products) {
            throw $this->createNotFoundException('No products found');
        }

        return new Response(var_dump($products));
    }

}
