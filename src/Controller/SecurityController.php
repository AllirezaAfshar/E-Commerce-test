<?php

namespace App\Controller;

use App\Entity\fakeUser;
use App\Form\LoginType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        // 1) build the form
        $user = new fakeUser();
        $error = '';
        $form = $this->createForm(LoginType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
            #$dbUser = $em->getRepository('App\Entity\User')->findOneBy(array('username' => $form['username']));
            if($form['password']){
                $session = new Session();

                $session->set('username__', 'Admin');
                return $this->redirectToRoute('home');
            }
            else{
                $error = 'wrong password';
            }
        }



        return $this->render('security/login.html.twig', array(
            'error'         => $error,
            'form' => $form->createView(),
        ));
    }
}