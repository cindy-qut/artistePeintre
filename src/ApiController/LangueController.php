<?php

namespace App\ApiController;

use App\Entity\Langue;
use App\Form\LangueType;
use App\Repository\LangueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;



/**
 * @Route("/langue", host="api.artpeintre.fr")
 */
class LangueController extends AbstractFOSRestController
{
    /**
     * @Route("/", name="languelist_api", methods={"GET"})
     * @Rest\View()
     */
    public function index(LangueRepository $langueRepository): View
    {
        $langue = $langueRepository->findAll();
        return View::create($langue, Response::HTTP_OK);
    }
    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="langueshow_api"
     * )
     */
    public function show(Langue $langue): View
    {
        return View::create($langue, Response::HTTP_OK);
    }
    /**
     * @Rest\Post(
     *     path="/new",
     *     name="languecreate_api"
     * )
     */
    public function new(Request $request): View
    {
        $langue = new Langue();
        $langue->setNom($request->get('nom'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($langue);
        $em->flush();
        return View::create($langue,Response::HTTP_CREATED);
    }
    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="languedelete_api"
     * )
     */
    public function delete(Langue $langue): View
    {
        if($langue){
            $em=$this->getDoctrine()->getManager();
            $em->remove($langue);
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
    public function edit(Request $request, Langue $langue)
    {
        if($langue){
            $langue->setNom($request->get('nom'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($langue);
            $em->flush();
        }
        return View::create($langue, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="languepatch_api"
     * )
     */
    public function patch(Request $request, Langue $langue)
    {
        if($langue){
            $form = $this->createForm(LangueType::class, $langue);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($langue);
            $em->flush();
        }
        return View::create($langue, Response::HTTP_OK);
    }

}
