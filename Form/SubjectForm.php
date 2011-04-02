<?php

namespace Max\SymForumBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\EntityChoiceField;
use Symfony\Component\Form\TextareaField;
use Symfony\Component\Form\CheckboxField;

class SubjectForm extends Form {

  public $type,$parent;
  /**
   * @validation:MaxLength(limit=100),
   * @validation:AssertType("string")
   * @var string
   */
  public $title;
  /**
   * @validation:MaxLength(limit=500),
   * @validation:AssertType("string")
   * @var string
   */
  public $description;
  /**
   * @validation:AssertType("boolean")
   */
  public $hide;
  /**
   * @validation:AssertType("boolean")
   */
  public $menu;

  public function configure() {
    $this->addOption('em');
    $em = $this->getOption('em');
    $this->setDataClass("\Max\SymForumBundle\Form\SubjectForm");
    // $this->setDataClass("\Max\SymForumBundle\Entity\Post");
    // $this->add(new TextField('text'));
    // $this->add(new EntityChoiceField('subject',array('em'=>$em,'property' => 'subject','class'=>'Max\SymForumBundle\Entity\Post')));
    /*
    $this->add(new EntityChoiceField('type',
            array(
                'em'=>$em,
                'property'=>'name',
                'class'=>'Max\SymForumBundle\Entity\Type'
                )
            ));
    
    $this->add(new EntityChoiceField('parent',
            array(
                'em'=>$em,
                'property'=>'title',
                'class'=>'Max\SymForumBundle\Entity\Subject'
                )
            ));*/
    $this->add('title');
    $this->add(new TextareaField('description'));
    $this->add(new CheckboxField('menu'));
    $this->add(new CheckboxField('hide'));
  }

}