<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Individual
 *
 * @ORM\Table(name="individual")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IndividualRepository")
 */
class Individual {

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
     * @ORM\Column(name="title", type="string", length=16)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="id2", type="integer",nullable=true)
     */
    private $id2;

    /**
     * @var string
     *
     * @ORM\Column(name="forename", type="string", length=64)
     */
    private $forename;

    /**
     * @var string
     *
     * @ORM\Column(name="middlename", type="string", length=64, nullable=true)
     */
    private $middlename;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=64)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="maidenname", type="string", length=64, nullable=true)
     */
    private $maidenname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=255, nullable=true)
     */
    private $phone2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=16, nullable=true)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="nin", type="string", length=32, nullable=true)
     */
    private $nin;

    /**
     * @var string
     *
     * @ORM\Column(name="utr", type="string", length=32, nullable=true)
     */
    private $utr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    protected $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by", referencedColumnName="id")
     */
    protected $updatedBy;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MaritialStatus")
     * @ORM\JoinColumn(name="maritial_status_id", referencedColumnName="id")
     */
    protected $maritialStatus;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="e_signature_password",type="string", length=64, nullable=true)
     */
    private $eSignaturePassword;

    /**
     * @var string
     * 
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="date_moved_in", type="date", nullable=true) 
     */
    private $dateMovedIn;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="date_disengaged", type="date", nullable=true)
     */
    private $dateDisengaged;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DisengegementReason")
     * @ORM\JoinColumn(name="disengegement_reason_id", referencedColumnName="id")
     */
    protected $disengegementReason;

    /**
     * @var string
     * @ORM\Column(name="archived", type="date", nullable=true)
     */
    private $archived;

    /**
     *
     * @var int
     * @ORM\Column(name="archive_number",type="integer",nullable=true) 
     */
    private $archiveNumber;

    /**
     *
     * @var string
     * @ORM\Column(name="archive_note",type="string", length=255, nullable=true)
     */
    private $archiveNote;

    /**
     *
     * @var string
     * @ORM\Column(name="bank_account_details",type="string", length=255, nullable=true)
     */
    private $bankAccountDetails;
    
    public $dobFrom;
    public $dobTo;
    public $dateDisengagedFrom;
    public $dateDisengagedTo;
    public $connections;
    public $proofOfAddress;
    public $archivedFrom;
    public $archivedTo;
    public $string;
    public $expiresTill;
    public $noId;

    
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @param Int $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id2
     *
     * @return int
     */
    public function getId2() {
        return $this->id2;
    }

    /**
     * 
     * @param Int $id
     * @return $this
     */
    public function setId2($id2) {
        $this->id2 = $id2;
        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Individual
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set forename
     *
     * @param string $forename
     *
     * @return Individual
     */
    public function setForename($forename) {
        $this->forename = $forename;

        return $this;
    }

    /**
     * Get forename
     *
     * @return string
     */
    public function getForename() {
        return $this->forename;
    }

    /**
     * Set middlename
     *
     * @param string $middlename
     *
     * @return Individual
     */
    public function setMiddlename($middlename) {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get middlename
     *
     * @return string
     */
    public function getMiddlename() {
        return $this->middlename;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Individual
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     *
     * @return Individual
     */
    public function setDob($dob) {
        if (strstr($dob, '/')) {
            $date = explode('/', $dob);
            $dob = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        $this->dob = new \DateTime($dob);

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime
     */
    public function getDob() {
        if (!empty($this->dob)) {
            return $this->dob->format('d/m/Y');
        }
        return null;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Individual
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     *
     * @return Individual
     */
    public function setPhone2($phone2) {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2
     *
     * @return string
     */
    public function getPhone2() {
        return $this->phone2;
    }

    /**
     * Set maidenname
     *
     * @param string $maidenname
     *
     * @return Individual
     */
    public function setMaidenname($maidenname) {
        $this->maidenname = $maidenname;

        return $this;
    }

    /**
     * Get maidenname
     *
     * @return string
     */
    public function getMaidenname() {
        return $this->maidenname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Individual
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Individual
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Individual
     */
    public function setPostcode($postcode) {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode() {
        return $this->postcode;
    }

    /**
     * Set nin
     *
     * @param string $nin
     *
     * @return Individual
     */
    public function setNin($nin) {
        $this->nin = $nin;

        return $this;
    }

    /**
     * Get nin
     *
     * @return string
     */
    public function getNin() {
        return $this->nin;
    }

    /**
     * Set utr
     *
     * @param string $utr
     *
     * @return Individual
     */
    public function setUtr($utr) {
        $this->utr = $utr;

        return $this;
    }

    /**
     * Get utr
     *
     * @return string
     */
    public function getUtr() {
        return $this->utr;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Individual
     */
    public function setCreated(\DateTime $created = null) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * 
     * @param type $createdBy
     * @return $this
     */
    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getCreatedBy() {
        return $this->createdBy;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Individual
     */
    public function setUpdated(\DateTime $updated = null) {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * 
     * @param type $updatedBy
     * @return $this
     */
    public function setUpdatedBy($updatedBy) {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    /**
     * 
     * @param type $notes
     * @return $this
     */
    public function setNotes($notes) {
        $this->notes = $notes;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getNotes() {
        return $this->notes;
    }

    /**
     * 
     * @param type $status
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * 
     * @return type
     */
    public function getMaritialStatus() {
        return $this->maritialStatus;
    }

    /**
     * 
     * @param type $maritialStatus
     * @return $this
     */
    public function setMaritialStatus($maritialStatus) {
        $this->maritialStatus = $maritialStatus;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getDateMovedIn() {
        if (!empty($this->dateMovedIn)) {
            return $this->dateMovedIn->format('d/m/Y');
        }
        return null;
    }

    /**
     * 
     * @param type $dateMovedIn
     * @return $this
     */
    public function setDateMovedIn($dateMovedIn) {
        if (strstr($dateMovedIn, '/')) {
            $date = explode('/', $dateMovedIn);
            $dateMovedIn = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        $this->dateMovedIn = new \DateTime($dateMovedIn);
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getDateDisengaged() {
        if (!empty($this->dateDisengaged)) {
            return $this->dateDisengaged->format('d/m/Y');
        }
        return null;
    }

    /**
     * 
     * @param type $dateDisengaged
     * @return $this
     */
    public function setDateDisengaged($dateDisengaged) {
        if (strstr($dateDisengaged, '/')) {
            $date = explode('/', $dateDisengaged);
            $dateDisengaged = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        $this->dateDisengaged = new \DateTime($dateDisengaged);
        return $this;
    }

    /**
     * 
     * @param type $disengegementReason
     * @return $this
     */
    public function setDisengegementReason($disengegementReason) {
        $this->disengegementReason = $disengegementReason;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getDisengegementReason() {
        return $this->disengegementReason;
    }

    /**
     * 
     * @return type
     */
    public function getArchived() {
        if (!empty($this->archived)) {
            return $this->archived->format('d/m/Y');
        }
        return null;
    }

    /**
     * 
     * @param type $archived
     * @return $this
     */
    public function setArchived($archived) {
        if (strstr($archived, '/')) {
            $date = explode('/', $archived);
            $archived = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        $this->archived = new \DateTime($archived);
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getArchiveNumber() {
        return $this->archiveNumber;
    }

    /**
     * 
     * @param type $archiveNumber
     * @return $this
     */
    public function setArchiveNumber($archiveNumber) {
        $this->archiveNumber = $archiveNumber;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getArchiveNote() {
        return $this->archiveNote;
    }

    /**
     * 
     * @param type $archiveNote
     * @return $this
     */
    public function setArchiveNote($archiveNote) {
        $this->archiveNote = $archiveNote;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getBankAccountDetails() {
        return $this->bankAccountDetails;
    }

    /**
     * 
     * @param type $bankAccountDetails
     * @return $this
     */
    public function setBankAccountDetails($bankAccountDetails) {
        $this->bankAccountDetails = $bankAccountDetails;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function __toString() {
        return 'ID: ' . $this->id . ' ' . $this->forename . ' ' . $this->lastname . ' ' . $this->email;
    }

    /**
     * 
     * @return string
     */
    public function getESignaturePassword() {
        return $this->eSignaturePassword;
    }

    /**
     * 
     * @param type $eSignaturePassword
     * @return $this
     */
    public function setESignaturePassword($eSignaturePassword) {
        $this->eSignaturePassword = $eSignaturePassword;
        return $this;
    }

    public function getDobFrom(){
        if (strstr($this->dobFrom, '/')) {
            $date = explode('/', $this->dobFrom);
            $this->dobFrom = $date[2] . '-' . $date[1] . '-' . $date[0];
        }

        return $this->dobFrom;
    }
    
    public function getDobTo(){
        if (strstr($this->dobTo, '/')) {
            $date = explode('/', $this->dobTo);
            $this->dobTo = $date[2] . '-' . $date[1] . '-' . $date[0];
        }

        return $this->dobTo;
    }
    
    public function getDateDisengagedFrom(){
        if (strstr($this->dateDisengagedFrom, '/')) {
            $date = explode('/', $this->dateDisengagedFrom);
            $this->dateDisengagedFrom = $date[2] . '-' . $date[1] . '-' . $date[0];
        }

        return $this->dateDisengagedFrom;
    }
    
    public function getDateDisengagedTo(){
        if (strstr($this->dateDisengagedTo, '/')) {
            $date = explode('/', $this->dateDisengagedTo);
            $this->dateDisengagedTo = $date[2] . '-' . $date[1] . '-' . $date[0];
        }

        return $this->dateDisengagedTo;
    }
    
    public function getConnections(){
        return $this->connections;
    }
    
    public function getProofOfAddress(){
        return $this->proofOfAddress;
    }
    
    public function getArchivedFrom(){
        if (strstr($this->archivedFrom, '/')) {
            $date = explode('/', $this->archivedFrom);
            $this->archivedFrom = $date[2] . '-' . $date[1] . '-' . $date[0];
        }

        return $this->archivedFrom;
    }
    
    public function getArchivedTO(){
        if (strstr($this->archivedTo, '/')) {
            $date = explode('/', $this->archivedTo);
            $this->archivedTo = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        return $this->archivedTo;
    }

    public function getString(){
        return $this->string;
    }

    public function getNoId(){
        return $this->noId;
    }

    public function getExpiresTill(){
        if (strstr($this->expiresTill, '/')) {
            $date = explode('/', $this->expiresTill);
            $this->expiresTill = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        return $this->expiresTill;
    }
}
