<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusinessIndividual
 *
 * @ORM\Table(name="business_individual")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusinessIndividualRepository")
 */
class BusinessIndividual
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PersonTypes")
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
     * 
     * @param type $type
     * @return $this
     */
    public function setType($type){
        $this->type = $type;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function getType(){
        return $this->type;
    }
}

