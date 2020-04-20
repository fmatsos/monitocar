<?php

namespace App\Controller\Vehicle;

use App\Entity\Vehicle\Vehicle;
use App\Form\Type\Vehicle\Vehicle as VehicleType;
use App\Repository\Vehicle\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vehicle")
 */
class VehicleController extends AbstractController
{
    /**
     * @Route("/", name="vehicle_vehicle_index", methods={"GET"})
     */
    public function index(VehicleRepository $vehicleRepository): Response
    {
        return $this->render('vehicle/vehicle/index.html.twig', [
            'vehicles' => $vehicleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vehicle_vehicle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_vehicle_index');
        }

        return $this->render('vehicle/vehicle/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vehicle_vehicle_show", methods={"GET"})
     */
    public function show(Vehicle $vehicle): Response
    {
        return $this->render('vehicle/vehicle/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vehicle_vehicle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vehicle $vehicle): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vehicle_vehicle_index');
        }

        return $this->render('vehicle/vehicle/edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vehicle_vehicle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vehicle $vehicle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicle_vehicle_index');
    }
}
