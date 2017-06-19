<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Business
 *
 * @ORM\Table(name="business")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusinessRepository")
 */
class Business
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=10)
     */
    private $postcode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="doi", type="date")
     */
    private $doi;

    /**
     * @var string
     *
     * @ORM\Column(name="cno", type="string", length=24)
     */
    private $cno;

    /**
     * @var string
     *
     * @ORM\Column(name="utr", type="string", length=24, nullable=true)
     */
    private $utr;

    /**
     * @var string
     *
     * @ORM\Column(name="vat", type="string", length=24, nullable=true)
     */
    private $vat;

    /**
     * @var string
     *
     * @ORM\Column(name="epaye", type="string", length=24, nullable=true)
     */
    private $epaye;

    /**
     * @var string
     *
     * @ORM\Column(name="accoff", type="string", length=64, nullable=true)
     */
    private $accoff;

    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=255, nullable=true)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

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
     * Set name
     *
     * @param string $name
     *
     * @return Business
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Business
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
     * @return Business
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
     * Set doi
     *
     * @param \DateTime $doi
     *
     * @return Business
     */
    public function setDoi($doi)
    {
        $this->doi = $doi;

        return $this;
    }

    /**
     * Get doi
     *
     * @return \DateTime
     */
    public function getDoi()
    {
        return $this->doi;
    }

    /**
     * Set cno
     *
     * @param string $cno
     *
     * @return Business
     */
    public function setCno($cno)
    {
        $this->cno = $cno;

        return $this;
    }

    /**
     * Get cno
     *
     * @return string
     */
    public function getCno()
    {
        return $this->cno;
    }

    /**
     * Set utr
     *
     * @param string $utr
     *
     * @return Business
     */
    public function setUtr($utr)
    {
        $this->utr = $utr;

        return $this;
    }

    /**
     * Get utr
     *
     * @return string
     */
    public function getUtr()
    {
        return $this->utr;
    }

    /**
     * Set vat
     *
     * @param string $vat
     *
     * @return Business
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return string
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set epaye
     *
     * @param string $epaye
     *
     * @return Business
     */
    public function setEpaye($epaye)
    {
        $this->epaye = $epaye;

        return $this;
    }

    /**
     * Get epaye
     *
     * @return string
     */
    public function getEpaye()
    {
        return $this->epaye;
    }

    /**
     * Set accoff
     *
     * @param string $accoff
     *
     * @return Business
     */
    public function setAccoff($accoff)
    {
        $this->accoff = $accoff;

        return $this;
    }

    /**
     * Get accoff
     *
     * @return string
     */
    public function getAccoff()
    {
        return $this->accoff;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return Business
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Business
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }
    
    public function __toString() {
        return 'ID: '.$this->id.' '.$this->name;
    }
}

