<?php

namespace App\Controller;

use App\Entity\Images;
use App\Form\ImagesType;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/images")
 */
class ImagesController extends AbstractController
{
    /**
     * @Route("/", name="images_index", methods={"GET"})
     */
    public function index(ImagesRepository $imagesRepository): Response
    {
        return $this->render('images/index.html.twig', [
            'images' => $imagesRepository->findAll(),
            'navimage' => true
        ]);
    }

    /**
     * @Route("/new", name="images_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $image = new Images();
        $form = $this->createForm(ImagesType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**@var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('file')->getData();
            if($file){
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('image_abs_path'),
                        $fileName);
                } catch (FileException $e){

                }
                $image->setPath($this->getParameter('image_abs_path').'/'.$fileName);
                $image->setImagePath($this->getParameter('image_path').'/'.$fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();

            return $this->redirectToRoute('images_index');
        }

        return $this->render('images/new.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="images_show", methods={"GET"})
     */
    public function show(Images $image): Response
    {
        return $this->render('images/show.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="images_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Images $image): Response
    {
        $form = $this->createForm(ImagesType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('file')->getData();
            if($file){
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('image_abs_path'),
                        $fileName);
                } catch (FileException $e){

                }
                $this->removeFile($image->getPath());
                $image->setPath($this->getParameter('image_abs_path').'/'.$fileName);
                $image->setImagePath($this->getParameter('image_path').'/'.$fileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('images_index', [
                'id' => $image->getId(),
            ]);
        }

        return $this->render('images/edit.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="images_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Images $image): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $this->removeFile($image->getPath());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('images_index');
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
