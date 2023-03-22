<?php

namespace App\Controller;

use App\DeliveryService\DeliveryCalculatorInterface;
use App\Form\DeliveryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainFormController extends AbstractController
{
    protected DeliveryCalculatorInterface $deliveryCalculator;

    public function __construct(DeliveryCalculatorInterface $deliveryCalculator)
    {
        $this->deliveryCalculator = $deliveryCalculator;
    }

    #[Route('/', name: 'app_main_form')]
    public function index(): Response
    {
        $form = $this->createForm(DeliveryType::class);

        return $this->render('main_form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/calc', name: 'app_main_calculator', methods: ['POST'])]
    public function calculator(Request $request): Response
    {
        $form = $this->createForm(DeliveryType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $responseData = $this->deliveryCalculator->calculate(...$data);
        } else {
            $responseData = [];
        }

        return $this->render('main_form/calculator.html.twig', [
            'form' => $form->createView(),
            'responseData' => $responseData
        ]);
    }
}
