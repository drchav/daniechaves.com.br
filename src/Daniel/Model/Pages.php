<?php
namespace Daniel\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pages")
 */
class Pages
{
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

    protected $slug;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     *
     * @var string
     */

    protected $title;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     *
     * @var string
     */

    protected $view;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */

    protected $content;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
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

    public function getView()
    {
        return $this->view;
    }

    public function setView( $view)
    {
        $this->view = $view;

        return $this;
    }

}
