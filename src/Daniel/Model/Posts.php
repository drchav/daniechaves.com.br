<?php
namespace Daniel\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Posts
{

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
     * @ORM\Column(type="text")
     *
     * @var string
     */

    protected $content;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     *
     * @var string
     */

    protected $slug;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     *
     * @var string
     */

    protected $title;

    public function getId()
    {
        return $this->id;
    }

    public function setId( $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated( $created)
    {
        $this->created = $created;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent( $content)
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug( $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle( $title)
    {
        $this->title = $title;

        return $this;
    }

}
