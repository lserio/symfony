<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;

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

    /**
     * @Route("/post/{post}/like", name="like_video", methods={"POST"})
     * @Route("/post/{post}/unlike", name="unlike_video", methods={"POST"})
     */
    public function toggleLikesAjax(Post $post, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        switch($request->get('_route')){
            case 'like_video':

                $user = $this->getDoctrine()->getRepository(User::class)->find($this->getUser());
                $user->addLike($post);
        
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
        
                $result = 'like';

            break;

            case 'unlike_video':
                $user = $this->getDoctrine()->getRepository(User::class)->find($this->getUser());
                $user->removeLike($post);
        
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
        
                $result = 'unlike';
            break;

        }

        return $this->json(['action' => $result, 'id' => $post->getId()]);
    }

}
