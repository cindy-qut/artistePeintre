<?php

namespace App\ApiController;

use App\Entity\Images;
use App\Entity\Types;
use App\Form\TypesType;
use App\Repository\TypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Route("/types", host="api.artpeintre.fr")
 */
class TypesController extends AbstractController
{
    /**
     * @Route("/", name="typeslist_api", methods={"GET"})
     * @Rest\View()
     */
    public function index(TypesRepository $typesRepository): View
    {
            $types = $typesRepository->findAll();
            return View::create($types, Response::HTTP_OK);
    }

    /**
     *
     * @Rest\Get(
     *      path="/{id}",
     *      name="typesshow_api"
     * )
     */
    public function show(Types $types): View
    {
    return View::create($types, Response::HTTP_OK);
    }


    /**
     * @Rest\Post(
     *     path="/new",
     *     name="typescreate_api"
     * )
     */
    public function new(Request $request): View
    {
        $types = new Types();
        $types->setImage($request->get('image'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($types);
        $em->flush();
        return View::create($types,Response::HTTP_CREATED);
    }
    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="typesdelete_api"
     * )
     */
    public function delete(Types $types): View
    {
        if ($types) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($types);
            $em->flush();
        }
    }
    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="typesedit_api"
     * )
     */
    public function edit(Request $request, Types $types)
    {
        if($types){
            $types->setDimensions($request->get('dimensions'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($types);
            $em->flush();
        }
        return View::create($types, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="typespatch_api"
     * )
     */
    public function patch(Request $request, Types $types)
    {
        if($types){
            $form = $this->createForm(TypesType::class, $types);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($types);
            $em->flush();
        }
        return View::create($types, Response::HTTP_OK);
    }




}
