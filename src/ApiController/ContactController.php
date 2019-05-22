<?php

namespace App\ApiController;

use App\Repository\ContactRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * @Route("/contact", host="api.artpeintre.fr")
 */
class ContactController extends AbstractFOSRestController
{
    /**
     * @Route("/", name="contactlist_api", methods={"GET"})
     * @Rest\View()
     */
    public function index(ContactRepository $contactRepository): View
    {
        $contact = $contactRepository->findAll();
        return View::create($contact, Response::HTTP_OK);
    }
}