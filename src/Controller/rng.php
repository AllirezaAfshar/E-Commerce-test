<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class rng extends Controller
{
	/**
	@Route("/rng/number")
	*/
    public function number()
    {
        $number = random_int(0, 100);

return $this->render('rng/number.html.twig', array(
            'number' => $number,));
    }
}
