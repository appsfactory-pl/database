<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndividualIndividual
 *
 * @ORM\Table(name="individual_individual")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IndividualIndividualRepository")
 */
class IndividualIndividual
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Individual")
     * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
     */
    protected $individual;
    
     /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Individual")
     * @ORM\JoinColumn(name="individual2_id", referencedColumnName="id")
     */
    protected $individual2;
    
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
     * @param type $individual
     * @return $this
     */
    public function setIndividual2($individual2){
        $this->individual2 = $individual2;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getIndividual2(){
        return $this->individual2;
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

