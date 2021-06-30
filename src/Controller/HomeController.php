<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

     /**
     * @Route("/home/menu", name="menu")
     */
    public function menu(): Response
    {
        return $this->render('home/menu.html.twig');
    }

     /**
     * @Route("/home/form", name="form")
     */
    public function form(): Response
    {
        return $this->render('home/form.html.twig');
    }


    /**
     * @Route("/home/message", name="message")
     */
    public function message(ContentRepository $contentRepository): Response
    {
        $lastInsert = $contentRepository->findOneBy([], ['id' => 'desc']);

        return $this->render('home/message.html.twig', [
            'controller_name' => 'DefaultController',
            'lastinsert' => $lastInsert,
        ]);
    }

    /**
     * @Route("/home/mines", name="mines")
     */
    public function imines(ContentRepository $contentRepository): Response
    {
        $myInserts = $contentRepository->findBy(['creator' => $this->getUser()], ['id' => 'desc']);

        return $this->render('home/mines.html.twig', [
            'controller_name' => 'DefaultController',
            'myInserts' => $myInserts,
        ]);
    }
}
