<?php
namespace Max\SymForumBundle\Entity;

/**
 * @orm:Entity
 */
class Log
{
    /**
     * @orm:Id
     * @orm:Column(type="bigint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @orm:Column(type="string")
     * 
     */
    protected $text;


    /**
     * @orm:Column(type="integer")
     *
     */
    protected $date;

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
     * Set date
     *
     * @param integer $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return integer $date
     */
    public function getDate()
    {
        return $this->date;
    }
}