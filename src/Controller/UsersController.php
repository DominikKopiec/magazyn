<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Entity\Roles;
use App\Repository\RolesRepository;
use App\Entity\UserToDepot;
use App\Repository\UserToDepotRepository;
use App\Entity\Depots;
use App\Repository\DepotsRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class UsersController extends AbstractController
{
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $users = $repository->findAll();

        return $this->render('users/index.html.twig', array(
            'users'=> $users,
        ));
    }

    public function add(Request $request): Response {
        $repo = $this->getDoctrine()->getRepository(Roles::class);
        $roles = $repo->findAll();

        $user = new Users();
        $form = $this->createFormBuilder($user)
            ->add('login', TextType::class, array('attr' => 
            array('class' => 'form-control')))
            ->add('password', TextType::class, array('attr' => 
            array('class' => 'form-control')))
            ->add('role', ChoiceType::class, [
                'choices' => $roles, 'choice_label' => 'name', 'attr' => array('class' => 'form-control')] )
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

                return $this->redirectToRoute('users');
            }

        return $this->render('users/newuser.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function showone(int $id, UsersRepository $UsersRepository): Response {
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $user = $repository->find($id);

        $repo = $this->getDoctrine()->getRepository(UserToDepot::class);
        $depots = $repo->findByUser($id);

        return $this->render('users/user.html.twig', array(
            'user' => $user,
            'depots' => $depots,
        ));
    }

    public function addDepot(int $id, Request $request, DepotsRepository $DepotsRepository): Response {
        $repo = $this->getDoctrine()->getRepository(Depots::class);
        $depots = $repo->findAll();

        $usertodepot = new UserToDepot();
        $form = $this->createFormBuilder($usertodepot)
            ->add('user', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'id',
                'attr' => array('class' => 'form-control', 'disabled' => true),
                'placeholder' => $id,
                
            ])
            ->add('depot', ChoiceType::class, [
                'choices' => $depots, 'choice_label' => 'name', 'attr' => array('class' => 'form-control')] )
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

                return $this->redirectToRoute('user', ['id' => $id]);
            }

        return $this->render('users/addDepot.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
