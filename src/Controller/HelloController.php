<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
    /**
     * @Route("/hello/sayHello", name="hello")
     */
    public function sayHello()
    {
        return  new Response(
            '<html><body> Hello </body></html>');
    }
}
