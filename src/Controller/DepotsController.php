<?php

namespace App\Controller;

use App\Entity\Depots;
use App\Repository\DepotsRepository;
use App\Entity\Status;
use App\Repository\StatusRepository;
use App\Entity\Articles;
use App\Repository\ArticlesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class DepotsController extends AbstractController
{
    public function show(DepotsRepository $DepotsRepository): Response {
        $repository = $this->getDoctrine()->getRepository(Depots::class);
        $depots = $repository->findAll();
   
        return $this->render('depots/index.html.twig', array(
            'depots'=> $depots,
        ));
    }
    public function showone(StatusRepository $StatusRepository,  Request $request, int $id): Response {

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $article = $repo->findAll();
        
        $status = new Status();
        $form = $this->createFormBuilder($status)
            ->add('depot', IntegerType::class, array('attr' => 
            array('class' => 'form-control', 'value'=>$id, 'empty_data' => '')))
            ->add('article', ChoiceType::class, [
                'choices' => $article, 'choice_label' => 'name', 'attr' => array('class' => 'form-control')] )
                
            ->add('unit', TextType::class, array('attr' => 
            array('class' => 'form-control', 'value' => $article[3]->getUnit()->getName(), 'disabled' => 'true')))
            ->add('code', TextType::class, array('attr' => 
            array('class' => 'form-control')))
            ->add('value', TextType::class, array('attr' => 
            array('class' => 'form-control')))
            ->add('vat', TextType::class, array('attr' => 
            array('class' => 'form-control')))
            ->add('price', TextType::class, array('attr' => 
            array('class' => 'form-control')))
            ->add('file', TextType::class, array('attr' => 
            array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Dodaj',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $task = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($task);
                $entityManager->flush();

                return $this->redirectToRoute('depot', array(
                    'id' => $id,
                ));
            }




        $repository = $this->getDoctrine()->getRepository(Status::class);
        $status = $repository->findByDepot($id);
        return $this->render('depots/depot.html.twig', array(
            'status' => $status,
            'form' => $form->createView()
        ));
    }

    public function add(Request $request): Response {

        $depot = new Depots();

        $form = $this->createFormBuilder($depot)
            ->add('name', TextType::class, array('attr' => 
            array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Dodaj',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $task = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($task);
                $entityManager->flush();

                return $this->redirectToRoute('depots');
            }

        return $this->render('depots/newdepot.html.twig', array(
            'form' => $form->createView()
        ));
    

    }
}
