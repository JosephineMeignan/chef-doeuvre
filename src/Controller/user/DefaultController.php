<?php

namespace App\Controller\user;

use App\Entity\Theme;
use App\Entity\Expert;
use App\Entity\User;
use App\Repository\ThemeRepository;
use App\Repository\ExpertRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ThemeRepository $themeRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'themes' => $themeRepository->findAll(),
        ]);
    }


}
