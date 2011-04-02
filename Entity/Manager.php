<?php
namespace Max\SymForumBundle\Entity;

/**
 * @orm:Entity
 */
class Manager
{
    /**
     * @orm:Id
     * @orm:Column(type="bigint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @orm:OneToMany(targetEntity="Max\SymForumBundle\Entity\Subject", mappedBy="manager")
     */
    public $subjects;

    public function __construct() {
        $this->subjects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @orm:Column(type="string")
     *
     */
    protected $name;

    /**
     * @orm:Column(type="string")
     * 
     */
    protected $description;

    /**
     * @orm:Column(type="integer", nullable=true)
     *
     */
    protected $hits;

    /**
     * @orm:Column(type="boolean", nullable=true)
     * @validation:AssertType("boolean")
     */
    protected $hide;

    /**
     * @orm:Column(type="boolean", nullable=true)
     * @validation:AssertType("boolean")
     */
    protected $ban;

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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
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
     * @param boolean $hide
     */
    public function setHide($hide)
    {
        $this->hide = $hide;
    }

    /**
     * Get hide
     *
     * @return boolean $hide
     */
    public function getHide()
    {
        return $this->hide;
    }

    /**
     * Set ban
     *
     * @param boolean $ban
     */
    public function setBan($ban)
    {
        $this->ban = $ban;
    }

    /**
     * Get ban
     *
     * @return boolean $ban
     */
    public function getBan()
    {
        return $this->ban;
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
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add subjects
     *
     * @param Max\SymForumBundle\Entity\Subject $subjects
     */
    public function addSubjects(\Max\SymForumBundle\Entity\Subject $subjects)
    {
        $this->subjects[] = $subjects;
    }

    /**
     * Get subjects
     *
     * @return Doctrine\Common\Collections\Collection $subjects
     */
    public function getSubjects()
    {
        return $this->subjects;
    }
}