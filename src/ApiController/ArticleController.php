<?php

namespace App\ApiController;

use App\Repository\ArticleRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * @Route("/article", host="api.artpeintre.fr")
 */
class ArticleController extends AbstractFOSRestController
{
    /**
     * @Route("/", name="articlelist_api", methods={"GET"})
     * @Rest\View()
     */
    public function index(ArticleRepository $articleRepository): View
    {
        $article = $articleRepository->findAll();
        return View::create($article, Response::HTTP_OK);
    }
}