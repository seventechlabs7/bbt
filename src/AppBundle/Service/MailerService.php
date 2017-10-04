<?php
namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Translation\TranslatorInterface;
/*ref : https://stackoverflow.com/questions/44111878/attempted-to-call-an-undefined-method-named-renderview-of-class */
class MailerService
{
    

    public function __construct(\Swift_Mailer $mailer, $templating,TranslatorInterface $translator)
{
    $this->mailer = $mailer;
    $this->templating = $templating;
     $this->translator = $translator;
}
   public function indexAction($mailObject)
{
    if($mailObject->type != 'Student')
    {
        $page ='Emails/registration.html.twig' ; 
    }
    else
        $page ='Emails/student_registration.html.twig' ;
    $message = (new \Swift_Message($this->translator->trans('subject_reg')))
        ->setFrom('profesores@bigbangtrading.com')
        ->setTo($mailObject->{'toMail'})
        ->setBody(           
                $this->templating->render(
                    // app/Resources/views/Emails/registration.html.twig
                    $page,
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

   public function mailChangeLink($mailObject)
{
        $page ='Emails/mailchange.html.twig' ; 
        $message = (new \Swift_Message($this->translator->trans('subject_mail_change')))
        ->setFrom('profesores@bigbangtrading.com')
        ->setTo($mailObject->{'toMail'})
        ->setBody(           
                $this->templating->render(

                    $page,
                    array('regObject' =>  $mailObject)
                ),
                'text/html'
        )
    ;
    
   $this->mailer->send($message);

    return new JsonResponse("successs");
}
public function mailChangeNotify($mailObject)
{
        $page ='Emails/mailnotify.html.twig' ; 
        $message = (new \Swift_Message($this->translator->trans('subject_mail_change_notify')))
        ->setFrom('profesores@bigbangtrading.com')
        ->setTo($mailObject->{'toMail'})
        ->setBody(           
                $this->templating->render(

                    $page,
                    array('regObject' =>  $mailObject)
                ),
                'text/html'
        )
    ;
    
   $this->mailer->send($message);

    return new JsonResponse("successs");
}
}