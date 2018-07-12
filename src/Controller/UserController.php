<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/user/insert/{username}/{password}/{role}", name="user_insert")
     */
    public function index($username,$password)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $user = new user();
        $user->setUsername($username);
        $user->setPassword($password);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        $userId = $user->getId();
        return $this->render('user/index.html.twig',array('userId'=>$userId));
    }
}
