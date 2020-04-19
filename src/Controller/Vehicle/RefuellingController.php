<?php

namespace App\Controller\Vehicle;

use App\Entity\Vehicle\Refuelling;
use App\Form\Vehicle\RefuellingType;
use App\Repository\Vehicle\RefuellingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vehicle/refuelling")
 */
class RefuellingController extends AbstractController
{
    /**
     * @Route("/", name="vehicle_refuelling_index", methods={"GET"})
     */
    public function index(RefuellingRepository $refuellingRepository): Response
    {
        return $this->render('vehicle/refuelling/index.html.twig', [
            'refuellings' => $refuellingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vehicle_refuelling_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $refuelling = new Refuelling();
        $form = $this->createForm(RefuellingType::class, $refuelling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($refuelling);
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_refuelling_index');
        }

        return $this->render('vehicle/refuelling/new.html.twig', [
            'refuelling' => $refuelling,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vehicle_refuelling_show", methods={"GET"})
     */
    public function show(Refuelling $refuelling): Response
    {
        return $this->render('vehicle/refuelling/show.html.twig', [
            'refuelling' => $refuelling,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vehicle_refuelling_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Refuelling $refuelling): Response
    {
        $form = $this->createForm(RefuellingType::class, $refuelling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vehicle_refuelling_index');
        }

        return $this->render('vehicle/refuelling/edit.html.twig', [
            'refuelling' => $refuelling,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vehicle_refuelling_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Refuelling $refuelling): Response
    {
        if ($this->isCsrfTokenValid('delete'.$refuelling->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($refuelling);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicle_refuelling_index');
    }
}
