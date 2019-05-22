<?php

namespace App\ApiController;

use App\Entity\Types;
use App\Form\TypesType;
use App\Repository\TypesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * @Route("/types", host="api.artpeintre.fr")
 */
class TypesController extends AbstractFOSRestController
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
}