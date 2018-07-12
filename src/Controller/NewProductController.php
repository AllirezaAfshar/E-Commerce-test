<?php

namespace App\Controller;

use App\Form\ProductType;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewProductController extends Controller
{
    /**
     * @Route("/new/product", name="new_product")
     */
    public function Create(Request $request)
    {
        // 1) build the form
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the product!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();


            return $this->redirectToRoute('list_product');
        }

        return $this->render(
            'new_product/index.html.twig',
            array('form' => $form->createView())
        );
    }
}
