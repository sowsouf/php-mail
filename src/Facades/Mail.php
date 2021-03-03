<?php
/**
 * This file contains Mail facade class.
 */

namespace Ssf\Mail\Facades;

use Ssf\Mail\Mailer;
use Ssf\Mail\Message;

/**
 * Class Mail
 * Cette classe contient la logique pour envoyer
 * un email.
 * Dans l'ordre, il faut :
 * - Créer l'objet avec @see Mail::create()
 * - Utiliser la méthode souhaité dans @see Mailer
 *  - @see Mailer::text() qui permet d'envoyer un e-mail texte
 *  - @see Mailer::html() qui permet d'envoyer un e-mail html
 * @package Ssf\Mail\Facades
 * @see Mailer
 */
class Mail
{
    /**
     * @param null $from
     * @param null $to
     * @return Mailer
     */
    public static function create($to = null, $from = null)
    {
        $message = new Message();
        $message->setTo($to ?? ssfmail_env('MAIL_TO'))
            ->setFrom($from ?? ssfmail_env('MAIL_FROM') ?? ssfmail_env('MAIL_USER'));
        return (new Mailer())->message($message);
    }
}