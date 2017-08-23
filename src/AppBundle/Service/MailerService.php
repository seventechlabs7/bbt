<?php
namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
/*ref : https://stackoverflow.com/questions/44111878/attempted-to-call-an-undefined-method-named-renderview-of-class */
class MailerService
{
    public function __construct(\Swift_Mailer $mailer, $templating)
{
    $this->mailer = $mailer;
    $this->templating = $templating;
}
   public function indexAction($mailObject)
{
    $message = (new \Swift_Message('BBT - Registration Success'))
        ->setFrom('admin@bbt.com')
        ->setTo($mailObject->{'toMail'})
        ->setBody(
            $this->templating->render(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/registration.html.twig',
                array('regObject' =>  $mailObject)
            ),
            'text/html'
        )
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
    ;

   $this->mailer->send($message);

    // or, you can also fetch the mailer service this way
    // $this->get('mailer')->send($message);

    return new JsonResponse("successs");
}
}