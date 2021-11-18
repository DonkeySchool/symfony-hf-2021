<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello/{name}", name="hello", methods={"GET"}, requirements={"name": "\w+"})
     */
    public function index(string $name = 'bob'): Response
    {
        return $this->render('hello/index.html.twig', [
            'name' => $name,
        ]);
    }
}
