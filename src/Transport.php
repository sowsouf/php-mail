<?php


namespace Ssf\Mail;


use Swift_SmtpTransport;

/**
 * Class Transport
 * @package Ssf\Mail
 */
class Transport
{
    /**
     * @var string|null $username
     */
    private $username;

    /**
     * @var string|null $password
     */
    private $password;

    /**
     * @var string|null $host
     */
    private $host;

    /**
     * @var string|null $port
     */
    private $port;

    /**
     * @var string|null $encryption
     */
    private $encryption;

    /**
     * @var Swift_SmtpTransport
     */
    private $transport;


    /**
     * Transport constructor.
     * @param array|null[] $parameters
     */
    public function __construct(array $parameters = array('username' => null, 'password' => null, 'host' => null, 'port' => null, 'encryption' => null))
    {
        $this->setUsername($parameters['username'] ?? ssfmail_env('MAIL_USER'));
        $this->setPassword($parameters['password'] ?? ssfmail_env('MAIL_PASSWORD'));
        $this->setHost($parameters['host'] ?? ssfmail_env('MAIL_HOST'));
        $this->setPort($parameters['port'] ?? ssfmail_env('MAIL_PORT'));
        $this->setEncryption($parameters['encryption'] ?? ssfmail_env('MAIL_ENCRYPTION'));

        $this->transport = (new Swift_SmtpTransport($this->host, $this->port, $this->encryption))
            ->setUsername($this->username)
            ->setPassword($this->password);
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string|null $host
     */
    public function setHost(?string $host): void
    {
        $this->host = $host;
    }

    /**
     * @param string|null $port
     */
    public function setPort(?string $port): void
    {
        $this->port = $port;
    }

    /**
     * @param string|null $encryption
     */
    public function setEncryption(?string $encryption): void
    {
        $this->encryption = $encryption;
    }

    /**
     * @return Swift_SmtpTransport
     */
    public function get(): Swift_SmtpTransport
    {
        return $this->transport;
    }

}