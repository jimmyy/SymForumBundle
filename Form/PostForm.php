<?php

namespace Max\SymForumBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\EntityChoiceField;
use Symfony\Component\Form\TextareaField;
use Symfony\Component\Form\CheckboxField;

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
   * @var boolean
   */
  public $hide;

  public function configure() {
    $this->addOption('em');
    $this->addOption('name');
    $em = $this->getOption('em');
    $this->name = $this->getOption('name');
    $this->setDataClass("\Max\SymForumBundle\Form\PostForm");
    // $this->setDataClass("\Max\SymForumBundle\Entity\Post");
    // $this->add(new TextField('text'));
    $this->add(new EntityChoiceField('subject',
            array(
                'em'=>$em,
                'property'=>'title',
                'class'=>'Max\SymForumBundle\Entity\Subject',
                /*
                'query_builder' => function($repository)
                  {
                   $q = $repository
                    ->createQueryBuilder('s')
                    ->leftJoin('s.type as t')
                    ->where("t.name!='category'");
                   // $q->setParameter('name', 'symforum');
                   return $q;
                  }*/
                )
            ));
    $this->add(new TextareaField('text'));
    $this->add(new CheckboxField('hide'));
  }

}