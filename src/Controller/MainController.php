<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request): Response
    {

        dump($request);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);

/*         return $this->json([
            'pippo' => 2
        ]); */

        /* return new Response('<h1>PROVA</h1>'); */
    }
}
