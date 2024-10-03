<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\AddCarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarRepository $carRepository): Response
    {
        $cars = $carRepository->findAll();

        return $this->render('accueil.html.twig', [
            'cars' => $cars
        ]);
    }

    #[Route('/details/{id}', name: 'app_details', methods: ['GET'])]
    public function details(?Car $car): Response
    {
        if (!$car) {
            $this->redirectToRoute('app_home');
        }

        return $this->render('car/details.html.twig', [
            'car' => $car
        ]);
    }

    #[Route('/remove/{id}', name: 'app_remove', methods: ['GET'])]
    public function remove(EntityManagerInterface $em, ?Car $car): Response{
        if ($car instanceof Car) {
            $em->remove($car);
            $em->flush();
        }
        return $this->redirectToRoute('app_home');
    }

    #[Route('/add', name: 'app_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $car = new Car();
        $form = $this->createForm(AddCarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('app_details', ['id' => $car->getId()]);
        }

        return $this->render('car/add-car.html.twig', [
            'form' => $form,
        ]);
    }
}
