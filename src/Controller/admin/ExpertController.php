<?php

namespace App\Controller\admin;

use App\Entity\Expert;
use App\Entity\User;
use App\Form\ExpertType;
use App\Repository\ExpertRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/expert", name="admin_expert_")
 */
class ExpertController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ExpertRepository $expertRepository, UserRepository $userRepository): Response
    {

        // $userExpert = $userRepository->findByExpert();
        // var_dump($userExpert);

        return $this->render('admin/expert/index.html.twig', [
            'experts' => $expertRepository->findAll(),
            'users' => $userRepository->findBy(['roles' =>  ["ROLE_EXPERT"]]),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $expert = new Expert();
        $form = $this->createForm(ExpertType::class, $expert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($expert);
            $entityManager->flush();

            return $this->redirectToRoute('admin_expert_index');
        }

        return $this->render('admin/expert/new.html.twig', [
            'expert' => $expert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Expert $expert): Response
    {
        return $this->render('admin/expert/show.html.twig', [
            'expert' => $expert,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Expert $expert): Response
    {
        $form = $this->createForm(ExpertType::class, $expert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_expert_index');
        }

        return $this->render('admin/expert/edit.html.twig', [
            'expert' => $expert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Expert $expert): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expert->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($expert);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_expert_index');
    }
}
