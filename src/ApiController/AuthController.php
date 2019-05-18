<?php
namespace App\ApiController;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserManagerInterface;

/**
 * @Rest\Route("/auth", host="artpeintre.fr")
 */
Class AuthController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(
     *      path="/profile",
     *      name="auth_profile_api")
     * @return View
     */
    public function profile(){
        return View::create($this->getUser(), Response::HTTP_OK);
    }
}