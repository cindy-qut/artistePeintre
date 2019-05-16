<?php

namespace App\Controller;

use App\Entity\TypesTranslation;
use App\Form\TypesTranslationType;
use App\Repository\TypesTranslationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/types/translation")
 */
class TypesTranslationController extends AbstractController
{
    /**
     * @Route("/", name="types_translation_index", methods={"GET"})
     */
    public function index(TypesTranslationRepository $typesTranslationRepository): Response
    {
        return $this->render('types_translation/index.html.twig', [
            'types_translations' => $typesTranslationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="types_translation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typesTranslation = new TypesTranslation();
        $form = $this->createForm(TypesTranslationType::class, $typesTranslation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typesTranslation);
            $entityManager->flush();

            return $this->redirectToRoute('types_translation_index');
        }

        return $this->render('types_translation/new.html.twig', [
            'types_translation' => $typesTranslation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="types_translation_show", methods={"GET"})
     */
    public function show(TypesTranslation $typesTranslation): Response
    {
        return $this->render('types_translation/show.html.twig', [
            'types_translation' => $typesTranslation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="types_translation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypesTranslation $typesTranslation): Response
    {
        $form = $this->createForm(TypesTranslationType::class, $typesTranslation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('types_translation_index', [
                'id' => $typesTranslation->getId(),
            ]);
        }

        return $this->render('types_translation/edit.html.twig', [
            'types_translation' => $typesTranslation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="types_translation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypesTranslation $typesTranslation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typesTranslation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typesTranslation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('types_translation_index');
    }
}
