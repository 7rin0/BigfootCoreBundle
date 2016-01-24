<?php

namespace Bigfoot\Bundle\CoreBundle\Mailer;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class AbstractMailer
 *
 * @package Bigfoot\Bundle\CoreBundle\Mailer
 */
abstract class AbstractMailer
{
    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     */
    protected $entityManager;
    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     */
    protected $mailer;
    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     */
    protected $templating;
    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     */
    protected $translator;
    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     */
    protected $mailFrom;

    /**
     * @param EntityManager $entityManager
     */
    public function setManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return mixed
     */
    public function getManager()
    {
        return $this->entityManager;
    }

    /**
     * @param \Swift_Mailer $mailer
     */
    public function setMailer(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @return mixed
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * @param EngineInterface $templating
     */
    public function setTemplating(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @return mixed
     */
    public function getTemplating()
    {
        return $this->templating;
    }

    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return mixed
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @param $mailFrom
     */
    public function setMailFrom($mailFrom)
    {
        $this->mailFrom = $mailFrom;
    }

    /**
     * @return mixed
     */
    public function getMailFrom()
    {
        return $this->mailFrom;
    }

    /**
     * @param      $subject
     * @param      $to
     * @param      $body
     * @param null $cc
     * @param null $bcc
     */
    public function sendMail($subject, $to, $body, $cc = null, $bcc = null)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->mailFrom)
            ->setTo($to)
            ->setContentType('text/html')
            ->setBody($body);

        if ($cc) {
            $message->setCc($cc);
        }

        if ($bcc) {
            $message->setBcc($bcc);
        }

        $this->mailer->send($message);
    }
}
