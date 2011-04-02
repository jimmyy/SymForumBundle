<?php
namespace Max\SymForumBundle\Entity;

/**
 * @orm:Entity
 */
class Post
{
    /**
     * @orm:Id
     * @orm:Column(type="bigint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @orm:ManyToOne(targetEntity="Max\SymForumBundle\Entity\Subject", inversedBy="posts")
     * @orm:JoinColumn(name="subject_id", referencedColumnName="id")
     *
     */
    protected $subject;

    /**
     * @orm:Column(type="string")
     * 
     */
    protected $text;

    /**
     * @orm:Column(type="integer", nullable=true)
     *
     */
    protected $hits;

    /**
     * @orm:Column(type="boolean", nullable=true)
     * @validation:AssertType("boolean")
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
     * Set text
     *
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
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
     * Set subject
     *
     * @param Max\SymForumBundle\Entity\Subject $subject
     */
    public function setSubject(\Max\SymForumBundle\Entity\Subject $subject)
    {
        $this->subject = $subject;
    }

    /**
     * Get subject
     *
     * @return Max\SymForumBundle\Entity\Subject $subject
     */
    public function getSubject()
    {
        return $this->subject;
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
}