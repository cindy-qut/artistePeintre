<?php

namespace App\ApiController;

use App\Repository\OeuvresRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
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
}