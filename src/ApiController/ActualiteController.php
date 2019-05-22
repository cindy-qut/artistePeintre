<?php

namespace App\ApiController;

use App\Repository\ActualiteRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * @Route("/actualite", host="api.artpeintre.fr")
 */
class ActualiteController extends AbstractFOSRestController
{
    /**
     * @Route("/", name="actualitelist_api", methods={"GET"})
     * @Rest\View()
     */
    public function index(ActualiteRepository $actualiteRepository): View
    {
        $actualite = $actualiteRepository->findAll();
        return View::create($actualite, Response::HTTP_OK);
    }
}