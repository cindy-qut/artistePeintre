<?php

namespace App\ApiController;

use App\Repository\LangueRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
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
}