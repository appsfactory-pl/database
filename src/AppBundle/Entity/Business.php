<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Business
 *
 * @ORM\Table(name="business")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusinessRepository")
 */
class Business {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id2", type="integer", nullable=true)
     */
    private $id2;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;

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
     * @var \DateTime
     *
     * @ORM\Column(name="doc", type="date", nullable=true)
     */
    private $doc;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\LegalForm")
     * @ORM\JoinColumn(name="legal_form_by", referencedColumnName="id")
     */
    protected $legalForm;

    /**
     *
     * @var type 
     * @ORM\Column(name="beta_page_link",type="string", length=64, nullable=true)
     */
    private $betaPageLink;

    /**
     *
     * @var type 
     * @ORM\Column(name="telephone",type="string", length=24, nullable=true)
     */
    private $telephone;

    /**
     *
     * @var type 
     * @ORM\Column(name="email",type="string", length=64, nullable=true)
     */
    private $email;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="accounts_office", type="string", length=255, nullable=true) 
     */
    private $accountsOffice;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="webfilling_email", type="string", length=64, nullable=true) 
     */
    private $webfillingEmail;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="webfilling_password", type="string", length=255, nullable=true) 
     */
    private $webfillingPassword;

    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="authentication_code", type="string", length=64, nullable=true) 
     */
    private $authenticationCode;

    
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
     * 
     * @ORM\Column(name="date_moved_in", type="date", nullable=true) 
     */
    private $dateMovedIn;

    public $dateDisengagedFrom;
    public $dateDisengagedTo;
    public $connections;
    public $proofOfAddress;
    public $archivedFrom;
    public $archivedTo;

    
    /**
     * 
     * @param type $id
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

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
     * @param type $id
     */
    public function setId2($id2) {
        $this->id2 = $id2;
        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId2() {
        return $this->id2;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Business
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Business
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
     * @return Business
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
     * Set doi
     *
     * @param \DateTime $doi
     *
     * @return Business
     */
    public function setDoi($doi) {
        if (strstr($doi, '/')) {
            $date = explode('/', $doi);
            $doi = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        $this->doi = new \DateTime($doi);

        return $this;
    }

    /**
     * Get doi
     *
     * @return \DateTime
     */
    public function getDoi() {
        if (!empty($this->doi)) {
            return $this->doi->format('d/m/Y');
        }
        return null;
    }
    /**
     * Set doi
     *
     * @param \DateTime $doi
     *
     * @return Business
     */
    public function setDoc($doc) {
        if (strstr($doc, '/')) {
            $date = explode('/', $doc);
            $doc = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        $this->doc = new \DateTime($doc);

        return $this;
    }

    /**
     * Get doi
     *
     * @return \DateTime
     */
    public function getDoc() {
        if (!empty($this->doc)) {
            return $this->doc->format('d/m/Y');
        }
        return null;
    }

    /**
     * Set cno
     *
     * @param string $cno
     *
     * @return Business
     */
    public function setCno($cno) {
        $this->cno = $cno;

        return $this;
    }

    /**
     * Get cno
     *
     * @return string
     */
    public function getCno() {
        return $this->cno;
    }

    /**
     * Set utr
     *
     * @param string $utr
     *
     * @return Business
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
     * Set vat
     *
     * @param string $vat
     *
     * @return Business
     */
    public function setVat($vat) {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return string
     */
    public function getVat() {
        return $this->vat;
    }

    /**
     * Set epaye
     *
     * @param string $epaye
     *
     * @return Business
     */
    public function setEpaye($epaye) {
        $this->epaye = $epaye;

        return $this;
    }

    /**
     * Get epaye
     *
     * @return string
     */
    public function getEpaye() {
        return $this->epaye;
    }

    /**
     * Set accoff
     *
     * @param string $accoff
     *
     * @return Business
     */
    public function setAccoff($accoff) {
        $this->accoff = $accoff;

        return $this;
    }

    /**
     * Get accoff
     *
     * @return string
     */
    public function getAccoff() {
        return $this->accoff;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return Business
     */
    public function setAccount($account) {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount() {
        return $this->account;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Business
     */
    public function setNotes($notes) {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes() {
        return $this->notes;
    }

    public function setLegalForm($legalForm) {
        $this->legalForm = $legalForm;
        return $this;
    }
    
    public function getLegalForm(){
        return $this->legalForm;
    }

    public function __toString() {
        return 'ID: ' . $this->id . ' ' . $this->name;
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
    public function getArchiveNote(){
        return $this->archiveNote;
    }

    /**
     * 
     * @param type $archiveNote
     * @return $this
     */
    public function setArchiveNote($archiveNote){
        $this->archiveNote = $archiveNote;
        return $this;
    }

    public function getTelephone(){
        return $this->telephone;
    }
    
    public function setTelephone($telephone){
        $this->telephone = $telephone;
        return $this;
    }
    
    public function getBetaPageLink(){
        return $this->betaPageLink;
    }
    
    public function setBetaPageLink($betaPageLink){
        $this->betaPageLink = $betaPageLink;
        return $this;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    
    public function getAccountsOffice(){
        return $this->accountsOffice;
    }
    
    public function setAccountsOffice($accuntsOffice){
        $this->accountsOffice = $accuntsOffice;
        return $this;
    }
    
    public function getWebfillingEmail(){
        return $this->webfillingEmail;
    }
    
    public function setWebfillingEmail($webfillingEmail){
        $this->webfillingEmail = $webfillingEmail;
        return $this;
    }
    
    public function getWebfillingPassword(){
        return $this->webfillingPassword;
    }
    
    public function setWebfillingPassword($webfillingPassword){
        $this->webfillingPassword = $webfillingPassword;
        return $this;
    }
    
    public function getAuthenticationCode(){
        return $this->authenticationCode;
    }
    
    public function setAuthenticationCode($authenticationCode){
        $this->authenticationCode = $authenticationCode;
        return $this;
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
     * @return string
     */
    public function getESignaturePassword(){
        return $this->eSignaturePassword;
    }
    
    /**
     * 
     * @param type $eSignaturePassword
     * @return $this
     */
    public function setESignaturePassword($eSignaturePassword){
        $this->eSignaturePassword = $eSignaturePassword;
        return $this;
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
}
