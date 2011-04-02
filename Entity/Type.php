<?php
namespace Max\SymForumBundle\Entity;

/**
 * @orm:Entity
 */

class Type
{
    /**
     * @orm:Id
     * @orm:Column(type="bigint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @orm:OneToMany(targetEntity="Max\SymForumBundle\Entity\Subject", mappedBy="type")
     */
    public $types;

    public function __construct() {
        $this->types = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @orm:Column(type="string")
     *
     */
    protected $name;

    /**
     * @orm:Column(type="string", nullable=true)
     *
     */
    protected $description;

    /**
     * @orm:Column(type="boolean", nullable=true)
     *
     */
    protected $hide ;

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
     * Add types
     *
     * @param Max\SymForumBundle\Entity\Subject $types
     */
    public function addTypes(\Max\SymForumBundle\Entity\Subject $types)
    {
        $this->types[] = $types;
    }

    /**
     * Get types
     *
     * @return Doctrine\Common\Collections\Collection $types
     */
    public function getTypes()
    {
        return $this->types;
    }
}