<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManageProductController extends Controller
{
    /**
     * @Route("/manage/product/edit/{id}", name="edit_product")
     */
    public function Edit(Request $request,$id)
    {
        $data = [];
        $product = new Product();
        $data['title'] = 'Edit Product';

        $form = $this-> createFormBuilder()
            ->add('title')
            ->add('description')
            ->add('color')
            ->add('price')
            ->getForm();

        $form ->handleRequest($request);

        if($form->isSubmitted()){
            $product = $form ->getData();
            $dbProduct = $this->getDoctrine()
                ->getRepository(Product::class)
                ->find($id);

            $dbProduct->setTitle($product['title']);
            $dbProduct->setDescription($product['description']);
            $dbProduct->setColor($product['color']);
            $dbProduct->setPrice($product['price']);

            $em = $this->getDoctrine()->getEntityManager();

            $em->flush();

            return $this->redirectToRoute("list_product");

        }
        else{
            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->find($id);

            $data['form'] = $product;
            return $this->render('manage_product/index.html.twig', $data);

        }

    }

    /**
     * @Route("/manage/product", name="list_product")
     */
    public function list()
    {
        $data = [];
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        $data['products'] = $products;
        $data['title'] = 'All Products';
        return $this->render('manage_product/list.html.twig', $data);
    }

    /**
     * @Route("/manage/product/delete/{id}", name="delete_product")
     */
    public function delete($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute("list_product");
    }
}
