<?php

namespace App\ApiController;

use App\Repository\ImagesRepository;
use App\Entity\Images;
use App\Form\ImagesType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/images", host="api.artpeintre.fr")
 */
class ImagesController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(
     *     path="/",
     *     name="imagelist_api")
     * @Rest\View()
     */
    public function index(ImagesRepository $imagesRepository): View
    {
        $images = $imagesRepository->findAll();
        return View::create($images, Response::HTTP_OK);
    }
    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="actushow_api"
     * )
     */
    public function show(Images $images): View
    {
        return View::create($images, Response::HTTP_OK);
    }
    /**
     * @Rest\Post(
     *     path="/new",
     *     name="imagecreate_api"
     * )
     */
    public function create(Request $request): View
    {
        $images = new Images();
        $images->setPath($request->get('path'));
        $images->setImgpath($request->get('image_path'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($images);
        $em->flush();
        return View::create($images, Response::HTTP_CREATED);
    }
    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="imagedelete_api"
     * )
     */
    public function delete(Images $images): View
    {
        if($images)
        {
            $em=$this->getDoctrine()->getManager();
            $em->remove($images);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }
    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="imageedit_api"
     * )
     */
    public function edit(Request $request, Images $images): View
    {
        if($images){
            $images->setImgpath($request->get('image_path'));
            $images->setPath($request->get('path'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($images);
            $em->flush();
        }
        return View::create($images, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="imagepatch_api"
     * )
     */
    public function patch(Request $request, Images $images)
    {
        if($images){
            $form=$this->createForm(ImagesType::class, $images);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($images);
            $em->flush();
        }
        return View::create($images, Response::HTTP_OK);
    }
}