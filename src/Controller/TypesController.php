<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Types;
use App\Form\TypesType;
use App\Repository\TypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/types")
 */
class TypesController extends AbstractController
{
    /**
     * @Route("/", name="types_index", methods={"GET"})
     */
    public function index(TypesRepository $typesRepository): Response
    {
        return $this->render('types/index.html.twig', [
            'types' => $typesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="types_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $type = new Types();
        $form = $this->createForm(TypesType::class, $type);
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
                $type->setImage($image);
            }
            else{
                $type->setImage(null);
            }
            $entityManager->persist($type);
            $entityManager->flush();

            return $this->redirectToRoute('types_index');
        }

        return $this->render('types/new.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="types_show", methods={"GET"})
     */
    public function show(Types $type): Response
    {
        return $this->render('types/show.html.twig', [
            'type' => $type,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="types_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Types $type): Response
    {
        $form = $this->createForm(TypesType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var  Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $image = $type->getImage();
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
                $type->setImage($image);
            }
            if(empty($image->getId())&& !$file){
                $type->setImage(null);
            }
            $entityManager->persist($type);
            $entityManager->flush();

            return $this->redirectToRoute('types_index', [
                'id' => $type->getId(),
            ]);
        }

        return $this->render('types/edit.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="types_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Types $type): Response
    {
        if ($this->isCsrfTokenValid('delete'.$type->getId(), $request->request->get('_token'))) {
            $image= $type->getImage();
            if($image)
            {
                $this->removeFile($image->getPath());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($type);
            $entityManager->flush();
        }

        return $this->redirectToRoute('types_index');
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
