<?php

namespace App\Controller;

use App\Entity\Taille;
use App\Entity\Oeuvres;
use App\Entity\Images;
use App\Form\OeuvresType;
use App\Repository\OeuvresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/oeuvres", host="artpeintre.fr")
 */
class OeuvresController extends AbstractController
{
    /**
     * @Route("/", name="oeuvres_index", methods={"GET"})
     */
    public function index(OeuvresRepository $oeuvresRepository): Response
    {
        return $this->render('oeuvres/index.html.twig', [
            'oeuvres' => $oeuvresRepository->findAll(),
            'navoeuvre' => true
        ]);
    }

    /**
     * @Route("/new", name="oeuvres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $oeuvres = new Oeuvres();
        $form = $this->createForm(OeuvresType::class, $oeuvres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var  Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('image')->get('file')->getData();
            if($file){
                $image = new Images();
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('image_abs_path'),
                        $fileName);
                } catch (FileException $e){

                }
                $image->setName($form->get('image')->get('name')->getData());
                $image->setPath($this->getParameter('image_abs_path').'/'.$fileName);
                $image->setImagePath($this->getParameter('image_path').'/'.$fileName);
                $entityManager->persist($image);
                $oeuvres->setImage($image);
            }
            else{
                $oeuvres->setImage(null);
            }
            $entityManager->persist($oeuvres);
            $entityManager->flush();

            return $this->redirectToRoute('oeuvres_index');
        }

        return $this->render('oeuvres/new.html.twig', [
            'oeuvre' => $oeuvres,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="oeuvres_show", methods={"GET"})
     */
    public function show(Oeuvres $oeuvres): Response
    {
        return $this->render('oeuvres/show.html.twig', [
            'oeuvre' => $oeuvres,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="oeuvres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Oeuvres $oeuvres): Response
    {
        $form = $this->createForm(OeuvresType::class, $oeuvres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var  Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $image = $oeuvres->getImage();
            $file = $form->get('image')->get('file')->getData();
            if($file)
            {
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('image_abs_path'),
                        $fileName);
                } catch (FileException $e){

                }
                $this->removeFile($image->getPath());
                $image->setName($form->get('image')->get('name')->getData());
                $image->setPath($this->getParameter('image_abs_path').'/'.$fileName);
                $image->setImagePath($this->getParameter('image_path').'/'.$fileName);
                $entityManager->persist($image);
                $oeuvres->setImage($image);

            }
            if(empty($image->getId())&& !$file){
                $oeuvres->setImage(null);
            }
            $entityManager->persist($oeuvres);
            $entityManager->flush();

            return $this->redirectToRoute('oeuvres_index', [
                'id' => $oeuvres->getId(),
            ]);
        }

        return $this->render('oeuvres/edit.html.twig', [
            'oeuvre' => $oeuvres,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="oeuvres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Oeuvres $oeuvres): Response
    {
        if ($this->isCsrfTokenValid('delete'.$oeuvres->getId(), $request->request->get('_token'))) {
            $image= $oeuvres->getImage();
            if($image)
            {
                $this->removeFile($image->getPath());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($oeuvres);
            $entityManager->flush();
        }

        return $this->redirectToRoute('oeuvres_index');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName(){
        return md5(uniqid());
    }
    private function removeFile($path){
        if(file_exists($path)){
            unlink($path);
        }
    }
}
