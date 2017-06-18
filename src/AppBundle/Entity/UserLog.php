<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserLog
 *
 * @ORM\Table(name="user_log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserLogRepository")
 */
class UserLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="login_date", type="datetime")
     */
    private $loginDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=20)
     */
    private $ipAddress;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set loginDate
     *
     * @param \DateTime $loginDate
     *
     * @return UserLog
     */
    public function setLoginDate($loginDate)
    {
        $this->loginDate = $loginDate;

        return $this;
    }

    /**
     * Get loginDate
     *
     * @return \DateTime
     */
    public function getLoginDate()
    {
        return $this->loginDate;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     *
     * @return UserLog
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }
    
    /**
     * 
     * @return object
     */
    public function getUser(){
        return $this->user;
    }

        /**
     * 
     * @param object $user
     * @return $this
     */
    public function setUser($user){
        
        $this->user = $user;
        return $this;
        
    }
    
}

