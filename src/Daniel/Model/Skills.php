<?php
namespace Daniel\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="skills")
 */
class Skills {

	/**
	 * @ORM\Id @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @var integer
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 *
	 * @var string
	 */

	protected $skill;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getSkill() {
		return $this->skill;
	}

	public function setSkill($skill) {
		$this->skill = $skill;
	}

}
