<?php

namespace App\ApiController;
use App\Entity\Taille;
use App\Form\TailleType;
use App\Repository\TailleRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * @Route("/taille", host="api.artpeintre.fr")
 */
class TailleController extends AbstractFOSRestController
{
    /**
     * @Route("/", name="taillelist_api", methods={"GET"})
     * @Rest\View()
     */
    public function index(TailleRepository $tailleRepository): View
    {
        $taille = $tailleRepository->findAll();
        return View::create($taille, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="tailleshow_api"
     * )
     */
    public function show(Taille $taille): View
    {
      return View::create($taille, Response::HTTP_OK);
    }

    /**
     * @Rest\Post(
     *     path="/new",
     *     name="taillecreate_api"
     * )
     */
    public function new(Request $request): View
    {
        $taille = new Taille();
        $taille->setDimensions($request->get('dimensions'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($taille);
        $em->flush();
        return View::create($taille,Response::HTTP_CREATED);
    }

    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="tailledelete_api"
     * )
     */
    public function delete(Taille $taille): View
    {
        if($taille){
            $em=$this->getDoctrine()->getManager();
            $em->remove($taille);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="tailleedit_api"
     * )
     */
    public function edit(Request $request, Taille $taille)
    {
        if($taille){
            $taille->setDimensions($request->get('dimensions'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($taille);
            $em->flush();
        }
        return View::create($taille, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="taillepatch_api"
     * )
     */
    public function patch(Request $request, Taille $taille)
    {
        if($taille){
            $form = $this->createForm(TailleType::class, $taille);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($taille);
            $em->flush();
        }
        return View::create($taille, Response::HTTP_OK);
    }
}