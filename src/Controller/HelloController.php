<?php

namespace App\Controller;

use App\Form\BookType;
use App\Payment\PaymentManager;
use App\Payment\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HelloController extends AbstractController
{
    private PaymentManager $paymentManager;

    public function __construct(PaymentManager $paymentManager)
    {
        $this->paymentManager = $paymentManager;
    }

    /**
     * @Route("/hello/{name}", name="hello", methods={"GET", "POST"}, requirements={"name": "\w+"})
     */
    public function index(string $name = 'bob', Request $request): Response
    {
        $form = $this->createForm(BookType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $book->save();
        }

        dump($this->paymentManager->payWith(10, 'stripe'));

        return $this->render('hello/index.html.twig', [
            'name' => $name,
            'form' => $form->createView(),
        ]);
    }
}
