<?php

namespace App\ApiController;
use App\Entity\Presentation;
use App\Form\PresentationType;
use App\Repository\OeuvresRepository;
use App\Repository\PresentationRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Route("/presentation", host="api.artpeintre.fr")
 */
class PresentationController extends AbstractFOSRestController
{
    /**
     * @Route("/", name="presentationlist_api", methods={"GET"})
     * @Rest\View()
     */
    public function index(PresentationRepository $presentationRepository): View
    {
        $presentation = $presentationRepository->findAll();
        return View::create($presentation, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="presentationshow_api"
     * )
     */
    public function show(Presentation $presentation): View
    {
        return View::create($presentation, Response::HTTP_OK);
    }

    /**
     * @Rest\Post(
     *     path="/new",
     *     name="presentationcreate_api"
     * )
     */
    public function new(Request $request): View
    {
        $presentation = new Presentation();
        $em = $this->getDoctrine()->getManager();
        $em->persist($presentation);
        $em->flush();
        return View::create($presentation,Response::HTTP_CREATED);
    }
    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="presentationdelete_api"
     * )
     */
    public function delete(Presentation $presentation): View
    {
        if($presentation){
            $em=$this->getDoctrine()->getManager();
            $em->remove($presentation);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }
    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="presentationedit_api"
     * )
     */
    public function edit(Request $request, Presentation $taille)
    {
        if($taille){
            $em=$this->getDoctrine()->getManager();
            $em->persist($taille);
            $em->flush();
        }
        return View::create($taille, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="presentationpatch_api"
     * )
     */
    public function patch(Request $request, Presentation $presentation)
    {
        if($presentation){
            $form = $this->createForm(PresentationType::class, $presentation);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($presentation);
            $em->flush();
        }
        return View::create($presentation, Response::HTTP_OK);
    }
}
