<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FileRepository")
 */
class File
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="fileName", type="string", length=255)
     */
    private $fileName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added", type="datetime")
     */
    private $added;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="additionalInfo", type="string", length=255, nullable=true)
     */
    private $additionalInfo;
    
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
     *
     * @var type 
     */
    public $file;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FileType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;

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
     * 
     * @param type $business
     * @return $this
     */
    public function setBusiness($business){
        $this->business = $business;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function getBusiness(){
        return $this->business;
    }
    
    /**
     * 
     * @param type $individual
     * @return $this
     */
    public function setIndividual($individual){
        $this->individual = $individual;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getIndividual(){
        return $this->individual;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return File
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     *
     * @return File
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return File
     */
    public function setDate($date)
    {
        if (strstr($date, '/')) {
            $d = explode('/', $date);
            $date = $d[2] . '-' . $d[1] . '-' . $d[0];
        }
        $this->date = new \DateTime($date);
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        if (!empty($this->date)) {
            return $this->date->format('d/m/Y');
        }
        return null;
    }

    /**
     * Set additionalInfo
     *
     * @param string $additionalInfo
     *
     * @return File
     */
    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;

        return $this;
    }

    /**
     * Get additionalInfo
     *
     * @return string
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }
    
    public function __toString() {
        return $this->path.$this->fileName;
    }

    /**
     * Get additionalInfo
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * 
     * @param type $type
     * @return $this
     */
    public function setType($type){
        $this->type = $type;
        return $this;
    }
    
    public function getFile(){
        return $this->file;
    }
    
}

