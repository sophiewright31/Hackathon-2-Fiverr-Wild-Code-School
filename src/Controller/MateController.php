<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MateController extends AbstractController
{
    /**
     * @Route("/mate", name="mate")
     */
    public function displayRandomPhotoArea(UserRepository $userRepository): Response
    {
        $photoAreas = array("https://avatars.githubusercontent.com/u/77840591?v=4",
            "https://avatars.githubusercontent.com/u/29205777?v=4",
            "https://avatars.githubusercontent.com/u/59830027?v=4",
            "https://avatars.githubusercontent.com/u/78907218?s=60&v=4",
            "https://avatars.githubusercontent.com/u/2752047?v=4");

        $randomNumber = array_rand($photoAreas);
        $randomImage = $photoAreas[$randomNumber];

        echo "<img src=\"$randomImage\" width=\"75\">";

        return $this->render('home/mate.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}