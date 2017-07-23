<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddressHistory
 *
 * @ORM\Table(name="address_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressHistoryRepository")
 */
class AddressHistory
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Business")
     * @ORM\JoinColumn(name="business_id", referencedColumnName="id")
     */
    protected $business;
    
     /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Individual")
     * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
     */
    protected $individual;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=20)
     */
    private $postcode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateMovedIn", type="date")
     */
    private $dateMovedIn;


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
     * Set business
     *
     * @param string $business
     *
     * @return AddressHistory
     */
    public function setBusiness($business)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return string
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Set individual
     *
     * @param string $individual
     *
     * @return AddressHistory
     */
    public function setIndividual($individual)
    {
        $this->individual = $individual;

        return $this;
    }

    /**
     * Get individual
     *
     * @return string
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return AddressHistory
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return AddressHistory
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set dateMovedIn
     *
     * @param \DateTime $dateMovedIn
     *
     * @return AddressHistory
     */
    public function setDateMovedIn($dateMovedIn)
    {
        $this->dateMovedIn = $dateMovedIn;

        return $this;
    }

    /**
     * Get dateMovedIn
     *
     * @return \DateTime
     */
    public function getDateMovedIn()
    {
        return $this->dateMovedIn;
    }
}

