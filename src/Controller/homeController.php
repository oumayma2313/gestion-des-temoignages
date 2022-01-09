<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Testimonials;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Form\TestimonialsFormType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class homeController extends AbstractController
{
    /**
     * @Route("/home" ,name="home" )
     * 
     */
    public function index(Request $request): Response
    {
        //page index pour remplir le formulaire et traiter les données

        $testimonials = $this->getDoctrine()->getRepository(Testimonials::class)->findAll();
        $test=new Testimonials();
        $form=$this->createFormBuilder($test)
             ->add('titre',TextType::class)
             ->add('image',FileType::class)
             ->add('message',TextareaType::class)
             ->add('save',SubmitType::class,array('label'=>'Ajouter un nouveu témoignage'))->getForm();       
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $msg = "success";

            $test=$form->getData();
            $test->setDateCreation(new \DateTime());
            $test->setStatut('en attente');

            $image = $form->get('image')->getData();
            $fileName = uniqid().'.'.$image->guessExtension();

            try{
                $image->move(
                  $this->getParameter('images_directory'),
                  $fileName
                );
              }catch(FileException $e){
            
              }
            $entityManager=$this->getDoctrine()->getManager();
            $test->setImage($fileName);
            $entityManager->persist($test);
            $entityManager->flush();

            return $this->render('index.html.twig',['form'=>$form->createView(),
            "testimonials" => $testimonials,"msg" => $msg]);
        }
        return $this->render('index.html.twig', ['form'=>$form->createView(),
            "testimonials" => $testimonials]);
    }
    
    /**
     * @Route("/admin" ,name="admin" )
     * 
     */
    public function admin()
    {
        //page admin avec les témoignages
        $testimonials = $this->getDoctrine()->getRepository(Testimonials::class)->findAll();
        
        return $this->render('admin.html.twig', ["testimonials" => $testimonials]);
    }
    /**
     * @Route("/refus" ,name="refus" )
     * 
     */
    public function refus()
    {
        //page refus avec les témoignages
        $testimonials = $this->getDoctrine()->getRepository(Testimonials::class)->findAll();
        
        return $this->render('refus.html.twig', ["testimonials" => $testimonials]);
    }
    /**
     * @Route("/rejeter{id}" ,name="rejeter" )
     * 
     */
    public function rejeter(Request $request, $id): Response
    {
        //fonction pour changer le statut d'un témoignage rejeté
        $entityManager = $this->getDoctrine()->getManager();
   
        $test = new Testimonials();
        $test = $this->getDoctrine()->getRepository(Testimonials::class)->find($id);

        $test->setStatut('rejeté');

        $entityManager->persist($test);
        $entityManager->flush();
        $testimonials = $this->getDoctrine()->getRepository(Testimonials::class)->findAll();
        
        return $this->redirectToRoute('admin', ["testimonials" => $testimonials]);
    }
    /**
     * @Route("/approuver{id}" ,name="approuver" )
     * 
     */
    public function approuver(Request $request, $id): Response
    {
        //fonction pour approuver un témoignage en attente
        $entityManager = $this->getDoctrine()->getManager();
   
        $test = new Testimonials();
        $test = $this->getDoctrine()->getRepository(Testimonials::class)->find($id);

        $test->setStatut('approuvé');

        $entityManager->persist($test);
        $entityManager->flush();
        $testimonials = $this->getDoctrine()->getRepository(Testimonials::class)->findAll();
        
        return $this->redirectToRoute('admin', ["testimonials" => $testimonials]);
    }
}