<?php

// src/Controller/MailerController.php
namespace App\Controller;

use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    #[Route('/send-email', name: 'app_send_email')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('sample-sender@binaryboxtuts.com')
            ->to('sample-recipient@binaryboxtuts.com')
            ->subject('Email Test')
            ->text('A sample email using mailtrap.');

        $mailer->send($email);
        return new Response(
            'Email sent successfully'
        );
    }
}