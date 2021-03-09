<?php

namespace Ssf\Mail;

use Ssf\Mail\Exceptions\NullMessageException;
use Ssf\Support\Traits\ForwardsCalls;
use Throwable;

/**
 * Class Mailer
 * Cette classe contient la logique de l'envoie
 * d'e-mail. Voir @see \Ssf\Mail\Facades\Mail pour
 * plus d'informations.
 * @package Ssf\Mail
 * @mixin Message
 */
class Mailer
{
    use ForwardsCalls;

    /**
     * @var Mailer null
     */
    private static $instance = null;

    /**
     * @var Transport $transport
     */
    private $transport;

    /**
     * @var \Swift_Mailer $mailer
     */
    private $mailer;

    /**
     * @var Message|null $message
     */
    private $message;

    private $failedRecipients;

    public function __construct()
    {
        $this->transport = new Transport();
        $this->mailer = new \Swift_Mailer($this->transport->get());
        $this->message = null;
        $this->failedRecipients = array();
    }

    /**
     * @param string $content
     * @param string|null $subject
     * @param Message|null $message
     * @return bool
     * @throws NullMessageException
     * @throws Throwable
     */
    public function text(string $content, string $subject = null, Message $message = null)
    {
        if (($this->message = $this->message ?? $message) === null)
            throw new NullMessageException();
        $this->message->setBody($content);
        if ($subject)
            $this->message->setSubject($subject);
        return $this->send();
    }

    /**
     * @param string $content
     * @param string|null $subject
     * @param Message|null $message
     * @return bool
     * @throws NullMessageException
     * @throws Throwable
     */
    public function html(string $content, string $subject = null, Message $message = null)
    {
        if (($this->message = $this->message ?? $message) === null)
            throw new NullMessageException();
        $this->message->setContentType('text/html')
            ->setBody($content, 'text/html')
            ->setSubject($subject);
        return $this->send();
    }

    /**
     * @return bool
     * @throws Throwable
     */
    public function send()
    {
        try {
            $this->mailer->send($this->message->getSwiftMessage(), $this->failedRecipients);
            return true;
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    /**
     * @param Message $message
     * @return $this
     */
    public function message(Message $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Dynamically pass missing methods to the Swift instance.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        $this->forwardCallTo($this->message, $method, $parameters);
        return $this;
    }
}