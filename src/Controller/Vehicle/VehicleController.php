<?php
/**
 * This file is part of the Monitocar application.
 *
 * Created by Franck Matsos <franck@matsos.fr>
 *
 * Last modified: 21/04/2020 00:55
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace App\Controller\Vehicle;

use App\Entity\Vehicle\Vehicle as VehicleEntity;
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
        $vehicle = new VehicleEntity();
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
    public function show(VehicleEntity $vehicle): Response
    {
        return $this->render('vehicle/vehicle/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vehicle_vehicle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, VehicleEntity $vehicle): Response
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
    public function delete(Request $request, VehicleEntity $vehicle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicle_vehicle_index');
    }
}
