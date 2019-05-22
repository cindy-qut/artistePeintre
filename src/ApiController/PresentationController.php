<?php

namespace App\ApiController;

use App\Repository\PresentationRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
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
}