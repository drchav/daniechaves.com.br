<?php
namespace Daniel\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="website")
 */
class Site {

	/**
	 * @ORM\Id @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @var integer
	 */
	protected $id;

	/**
	 * @ORM\Column(type="datetime")
	 * @var datetime
	 */
	protected $created;

	/**
	 * @ORM\Column(type="string", length=150)
	 *
	 * @var string
	 */
	private $sitename;

	/**
	 * @ORM\Column(type="string", length=500)
	 *
	 * @var string
	 */
	private $sitefooter;

	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 *
	 * @var string
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 *
	 * @var string
	 */
	private $emailserver;

	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 *
	 * @var string
	 */
	private $emailpassword;

	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 *
	 * @var string
	 */
	private $emailsendport;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 *
	 * @var string
	 */
	private $foto;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 *
	 * @var string
	 */
	private $telefonefixo;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 *
	 * @var string
	 */
	private $telefonecelular;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 *
	 * @var string
	 */
	private $siteurl;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 *
	 * @var string
	 */
	private $emailcontato;

	public function getTelefonefixo() {
		return $this->telefonefixo;
	}

	public function setTelefonefixo($telefonefixo) {
		$this->telefonefixo = $telefonefixo;
	}

	public function getTelefonecelular() {
		return $this->telefonecelular;
	}

	public function setTelefonecelular($telefonecelular) {
		$this->telefonecelular = $telefonecelular;
	}

	public function getSiteurl() {
		return $this->siteurl;
	}

	public function setSiteurl($siteurl) {
		$this->siteurl = $siteurl;
	}

	public function getEmailcontato() {
		return $this->emailcontato;
	}

	public function setEmailcontato($emailcontato) {
		$this->emailcontato = $emailcontato;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function getCreated() {
		return $this->created;
	}

	public function setCreated(datetime $created) {
		$this->created = $created;
		return $this;
	}

	public function getSitename() {
		return $this->sitename;
	}

	public function setSitename($sitename) {
		$this->sitename = $sitename;
		return $this;
	}

	public function getSitefooter() {
		return $this->sitefooter;
	}

	public function setSitefooter($sitefooter) {
		$this->sitefooter = $sitefooter;
		return $this;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			throw new \InvalidArgumentException('INVALID EMAIL');
		}
		return $this->email = $email;
	}

	public function getEmailserver() {
		return $this->emailserver;
	}

	public function setEmailserver($emailserver) {
		$this->emailserver = $emailserver;
		return $this;
	}

	public function getEmailpassword() {
		return $this->emailpassword;
	}

	public function setEmailpassword($emailpassword) {
		$this->emailpassword = $emailpassword;
		return $this;
	}

	public function getEmailsendport() {
		return $this->emailsendport;
	}

	public function setEmailsendport($emailsendport) {
		$this->emailsendport = $emailsendport;
		return $this;
	}

	public function getFoto() {
		return $this->foto;
	}

	public function setFoto($foto) {
		$this->foto = $foto;
		return $this;
	}

}
