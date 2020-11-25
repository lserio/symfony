<?php

namespace App\Controller;

use App\Entity\Post;
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

        //dump($request);

        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'posts' => $posts
        ]);

/*         return $this->json([
            'pippo' => 2
        ]); */

        /* return new Response('<h1>PROVA</h1>'); */
    }

}
