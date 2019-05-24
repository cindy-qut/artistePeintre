<?php

namespace App\ApiController;

use App\Entity\Oeuvres;
use App\Form\OeuvresType;
use App\Repository\OeuvresRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Route("/oeuvres", host="api.artpeintre.fr")
 */
class OeuvresController extends AbstractFOSRestController
{
    /**
     * @Route("/", name="oeuvreslist_api", methods={"GET"})
     * @Rest\View()
     */
    public function index(OeuvresRepository $oeuvresRepository): View
    {
        $oeuvres = $oeuvresRepository->findAll();
        return View::create($oeuvres, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="oeuvresshow_api"
     * )
     */
    public function show(Oeuvres $oeuvres): View
    {
        return View::create($oeuvres, Response::HTTP_OK);
    }

    /**
     * @Rest\Post(
     *     path="/new",
     *     name="taillecreate_api"
     * )
     */
    public function new(Request $request): View
    {
        $oeuvres = new Oeuvres();
        $oeuvres->setTarif($request->get('tarif'));
        $oeuvres->setImage($request->get('image'));
        $oeuvres->setTaille($request->get('taille'));
        $oeuvres->setType($request->get('type'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($oeuvres);
        $em->flush();
        return View::create($oeuvres,Response::HTTP_CREATED);
    }
    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="oeuvresdelete_api"
     * )
     */
    public function delete(Oeuvres $oeuvres): View
    {
        if($oeuvres){
            $em=$this->getDoctrine()->getManager();
            $em->remove($oeuvres);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }
    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="oeuvresedit_api"
     * )
     */
    public function edit(Request $request, Oeuvres $oeuvres)
    {
        if($oeuvres){
            $oeuvres->setTarif($request->get('tarif'));
            $oeuvres->setImage($request->get('image'));
            $oeuvres->setTaille($request->get('taille'));
            $oeuvres->setType($request->get('type'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($oeuvres);
            $em->flush();
        }
        return View::create($oeuvres, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="oeuvrespatch_api"
     * )
     */
    public function patch(Request $request, Oeuvres $oeuvres)
    {
        if($oeuvres){
            $form = $this->createForm(TailleType::class, $oeuvres);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($oeuvres);
            $em->flush();
        }
        return View::create($oeuvres, Response::HTTP_OK);
    }
}
