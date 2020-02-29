<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/sendMail", name="send_mail")
     * @Method("POST")
     */


    public function sendEmail(MailerInterface $mailer, Request $request):JsonResponse
    {
        $nb_jour_campagne = $request->get('nb_jour_campagne');
        $nb_evenement = $request->get('nb_evenement');
        $nb_selected_station = $request->get('nb_selected_station');
        $nb_selected_participant = $request->get('nb_selected_participant');
        $email = $request->get('email');
     
        $email = (new TemplatedEmail())
            ->from('mailer.adhere@gmail.com')
            ->to('imedsa@hotmail.fr')
            ->cc('corbault@gmail.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Récapitulatif Devis AdHere')
            ->htmlTemplate('email.html.twig')
            ->context([
                'nb_jour_campagne' => $nb_jour_campagne,
                'nb_evenement' => $nb_evenement,
                'nb_selected_station' => $nb_selected_station,
                'nb_selected_station' => $nb_selected_participant,    
            ]);

        $mailer->send($email);
        return new JsonResponse('Email Sent !',200);

    }

}
