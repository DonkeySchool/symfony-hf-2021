<?php

namespace App\Controller;

use App\Payment\PaymentManager;
use App\Payment\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/hello/{name}", name="hello", methods={"GET"}, requirements={"name": "\w+"})
     */
    public function index(string $name = 'bob'): Response
    {
       dump($this->paymentManager->payWith(10, 'stripe'));

        return $this->render('hello/index.html.twig', [
            'name' => $name,
        ]);
    }
}
