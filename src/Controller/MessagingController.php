<?php

namespace App\Controller;

use App\Entity\Messaging;
use App\Entity\User;
use App\Form\MessagingType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class MessagingController
 * @package App\Controller
 * @Route ("/messaging", name="messaging_")
 */
class MessagingController extends AbstractController
{
    /**
     * @Route("/{id}", name="index")
     */
    public function index(Request $request, EntityManagerInterface $em, UserRepository $userRepository, User $user): Response
    {
        $messaging = new Messaging();
        $userRand = $userRepository->findBy(['id' => rand(0,10)]);
        $form = $this->createForm(MessagingType::class, $messaging);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $messaging->setSender($this->getUser());
            $messaging->setSendAt(new \DateTime('now'));
            $messaging->setReceiver($userRand[0]);
            $em->persist($messaging);
            $em->flush();
            $this->addFlash("success", "Your message has been sent !");

            return $this->redirectToRoute('home');
        }
        return $this->render('messaging/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
