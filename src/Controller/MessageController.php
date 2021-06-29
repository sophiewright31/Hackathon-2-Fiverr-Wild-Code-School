<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\MessageType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MessageController
 * @package App\Controller
 * @Route("/message", name="message_")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/select", name="select")
     */
    public function index(Content $content, Request $request): Response
    {
        $form = $this->createForm(MessageType::class, $content);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render('message/index.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }
}
