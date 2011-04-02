<?php

namespace Max\SymForumBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\EntityChoiceField;
use Symfony\Component\Form\TextareaField;

class PostForm extends Form {

  public $subject;
  /**
   * @validation:MaxLength(limit=1000),
   * @validation:AssertType("string")
   * @var string
   */
  public $text;
  /**
   * @validation:AssertType("boolean")
   */
  public $hide;

  public function configure() {
    $this->addOption('em');
    $em = $this->getOption('em');
    $this->setDataClass("\Max\SymForumBundle\Form\PostForm");
    // $this->setDataClass("\Max\SymForumBundle\Entity\Post");
    // $this->add(new TextField('text'));
    $this->add(new EntityChoiceField('subject',
            array(
                'em'=>$em,
                'property'=>'title',
                'class'=>'Max\SymForumBundle\Entity\Subject'
                )
            ));
    $this->add(new TextareaField('text'));
    $this->add('hide');
  }

}