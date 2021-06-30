<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/defaultlast", name="defaultlast")
     */
    public function indexlast(ContentRepository $contentRepository): Response
    {
        $lastInsert = $contentRepository->findOneBy([], ['id' => 'desc']);

        return $this->render('home/indexlast.html.twig', [
            'controller_name' => 'DefaultController',
            'lastinsert' => $lastInsert,
        ]);
    }

    /**
     * @Route("/defaultmines", name="defaultmines")
     */
    public function indexmines(ContentRepository $contentRepository): Response
    {
        $myInserts = $contentRepository->findBy(['creator' => $this->getUser()], ['id' => 'desc']);

        return $this->render('home/indexmines.html.twig', [
            'controller_name' => 'DefaultController',
            'myInserts' => $myInserts,
        ]);
    }

}
