<?php

namespace Daniel\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Daniel\Model\User
 */
class User
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var datetime $created
     */
    private $created;

    /**
     * @var string $sitename
     */
    private $sitename;

    /**
     * @var string $sitefooter
     */
    private $sitefooter;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $emailserver
     */
    private $emailserver;

    /**
     * @var string $emailpassword
     */
    private $emailpassword;

    /**
     * @var string $emailsendport
     */
    private $emailsendport;

    /**
     * @var string $foto
     */
    private $foto;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set sitename
     *
     * @param string $sitename
     * @return User
     */
    public function setSitename($sitename)
    {
        $this->sitename = $sitename;
        return $this;
    }

    /**
     * Get sitename
     *
     * @return string 
     */
    public function getSitename()
    {
        return $this->sitename;
    }

    /**
     * Set sitefooter
     *
     * @param string $sitefooter
     * @return User
     */
    public function setSitefooter($sitefooter)
    {
        $this->sitefooter = $sitefooter;
        return $this;
    }

    /**
     * Get sitefooter
     *
     * @return string 
     */
    public function getSitefooter()
    {
        return $this->sitefooter;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set emailserver
     *
     * @param string $emailserver
     * @return User
     */
    public function setEmailserver($emailserver)
    {
        $this->emailserver = $emailserver;
        return $this;
    }

    /**
     * Get emailserver
     *
     * @return string 
     */
    public function getEmailserver()
    {
        return $this->emailserver;
    }

    /**
     * Set emailpassword
     *
     * @param string $emailpassword
     * @return User
     */
    public function setEmailpassword($emailpassword)
    {
        $this->emailpassword = $emailpassword;
        return $this;
    }

    /**
     * Get emailpassword
     *
     * @return string 
     */
    public function getEmailpassword()
    {
        return $this->emailpassword;
    }

    /**
     * Set emailsendport
     *
     * @param string $emailsendport
     * @return User
     */
    public function setEmailsendport($emailsendport)
    {
        $this->emailsendport = $emailsendport;
        return $this;
    }

    /**
     * Get emailsendport
     *
     * @return string 
     */
    public function getEmailsendport()
    {
        return $this->emailsendport;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return User
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }
}