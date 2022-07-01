<?php

namespace App\Controller\Back;

use App\Entity\Destinations;
use App\Form\DestinationsType;
use App\Repository\DestinationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/destinations")
 */
class DestinationsController extends AbstractController
{
    /**
     * @Route("/", name="destinations_index", methods={"GET"})
     */
    public function index(DestinationsRepository $destinationsRepository): Response
    {
        return $this->render('destinations/index.html.twig', [
            'destinations' => $destinationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="destinations_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $destination = new Destinations();
        $form = $this->createForm(DestinationsType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('destinations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('destinations/new.html.twig', [
            'destination' => $destination,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="destinations_show", methods={"GET"})
     */
    public function show(Destinations $destination): Response
    {
        return $this->render('destinations/show.html.twig', [
            'destination' => $destination,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="destinations_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Destinations $destination, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DestinationsType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('destinations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('destinations/edit.html.twig', [
            'destination' => $destination,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="destinations_delete", methods={"POST"})
     */
    public function delete(Request $request, Destinations $destination, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$destination->getId(), $request->request->get('_token'))) {
            $entityManager->remove($destination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('destinations_index', [], Response::HTTP_SEE_OTHER);
    }
}
