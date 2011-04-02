<?php
namespace Max\SymForumBundle\Entity;

/**
 * @orm:Entity
 */

class Subject
{
    /**
     * @orm:Id
     * @orm:Column(type="bigint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @orm:ManyToOne(targetEntity="Max\SymForumBundle\Entity\Manager", inversedBy="subjects")
     * @orm:JoinColumn(name="manager_id", referencedColumnName="id")
     *
     */
    protected $manager;

    /**
     *
     * @orm:ManyToOne(targetEntity="Max\SymForumBundle\Entity\Type", inversedBy="subjects")
     * @orm:JoinColumn(name="type_id", referencedColumnName="id")
     *
     */
    protected $type;

    /**
     *
     * @orm:ManyToOne(targetEntity="Max\SymForumBundle\Entity\Subject", inversedBy="childs")
     * @orm:JoinColumn(name="parent_id", referencedColumnName="id")
     *
     */
    protected $parent;

    /**
     * @orm:OneToMany(targetEntity="Max\SymForumBundle\Entity\Subject", mappedBy="parent")
     */
    public $childs;

    /**
     * @orm:OneToMany(targetEntity="Max\SymForumBundle\Entity\Post", mappedBy="subject")
     */
    public $posts;

    public function __construct() {
      $this->childs = new \Doctrine\Common\Collections\ArrayCollection();
      $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @orm:Column(type="string")
     *
     */
    protected $title;

    /**
     * @orm:Column(type="string", nullable=true)
     *
     */
    protected $description;

    /**
     * @orm:Column(type="boolean", nullable=true)
     *
     */
    protected $menu;

    /**
     * @orm:Column(type="integer", nullable=true)
     *
     */
    protected $hits;

    /**
     * @orm:Column(type="boolean", nullable=true)
     *
     */
    protected $hide ;

    /**
     * @orm:Column(type="integer", nullable=true)
     *
     */
    protected $author;

    /**
     * @orm:Column(type="datetime", nullable=true)
     *
     */
    protected $createdAt;

    /**
     * @orm:Column(type="datetime", nullable=true)
     *
     */
    protected $updatedAt;

    /**
     * Get id
     *
     * @return bigint $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set hits
     *
     * @param integer $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * Get hits
     *
     * @return integer $hits
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set hide
     *
     * @param integer $hide
     */
    public function setHide($hide)
    {
        $this->hide = $hide;
    }

    /**
     * Get hide
     *
     * @return integer $hide
     */
    public function getHide()
    {
        return $this->hide;
    }

    /**
     * Set author
     *
     * @param integer $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return integer $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add posts
     *
     * @param Max\SymForumBundle\Entity\Post $posts
     */
    public function addPosts(\Max\SymForumBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set createdAt
     *
     * @param integer $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return integer $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param integer $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return integer $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set menu
     *
     * @param boolean $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    /**
     * Get menu
     *
     * @return boolean $menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set type
     *
     * @param integer $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return integer $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set manager
     *
     * @param Max\SymForumBundle\Entity\Manager $manager
     */
    public function setManager(\Max\SymForumBundle\Entity\Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Get manager
     *
     * @return Max\SymForumBundle\Entity\Manager $manager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set parent
     *
     * @param Max\SymForumBundle\Entity\Subject $parent
     */
    public function setParent(\Max\SymForumBundle\Entity\Subject $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Max\SymForumBundle\Entity\Subject $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add childs
     *
     * @param Max\SymForumBundle\Entity\Subject $childs
     */
    public function addChilds(\Max\SymForumBundle\Entity\Subject $childs)
    {
        $this->childs[] = $childs;
    }

    /**
     * Get childs
     *
     * @return Doctrine\Common\Collections\Collection $childs
     */
    public function getChilds()
    {
        return $this->childs;
    }
}