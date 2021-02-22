<?php

namespace App\Controller\user;

use App\Entity\Message;
use App\Entity\Theme;
use App\Entity\Echange;
use App\Form\MessageType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends AbstractController
{

    /**
     * @Route("/theme/{id}", name="theme_show", methods={"GET", "POST"})
     */
    public function themeShow(Theme $theme, Request $request): Response
    {
        $echange = new Echange();
        $echange->setTheme($theme);

        $message = new Message();
        $message->setEchange($echange)
        //Récupère UserConnect
                ->setSender($this->getUser());

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setCreatedAt(new DateTime ('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        $experts = $theme->getUsers();
      
        return $this->render('user/show.html.twig', [
            'theme' => $theme,
            'experts' => $experts,
            'echangeForm' => $form->createView(),
        ]);
    }
}
