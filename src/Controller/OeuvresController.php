<?php

namespace App\Controller;

use App\Entity\Oeuvres;
use App\Form\OeuvresType;
use App\Repository\OeuvresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/oeuvres")
 */
class OeuvresController extends AbstractController
{
    /**
     * @Route("/", name="oeuvres_index", methods={"GET"})
     */
    public function index(OeuvresRepository $oeuvresRepository): Response
    {
        return $this->render('oeuvres/index.html.twig', [
            'oeuvres' => $oeuvresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="oeuvres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $oeuvre = new Oeuvres();
        $form = $this->createForm(OeuvresType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oeuvre);
            $entityManager->flush();

            return $this->redirectToRoute('oeuvres_index');
        }

        return $this->render('oeuvres/new.html.twig', [
            'oeuvre' => $oeuvre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="oeuvres_show", methods={"GET"})
     */
    public function show(Oeuvres $oeuvre): Response
    {
        return $this->render('oeuvres/show.html.twig', [
            'oeuvre' => $oeuvre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="oeuvres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Oeuvres $oeuvre): Response
    {
        $form = $this->createForm(OeuvresType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('oeuvres_index', [
                'id' => $oeuvre->getId(),
            ]);
        }

        return $this->render('oeuvres/edit.html.twig', [
            'oeuvre' => $oeuvre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="oeuvres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Oeuvres $oeuvre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$oeuvre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($oeuvre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('oeuvres_index');
    }
}
