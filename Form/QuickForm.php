<?php

namespace Max\SymForumBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\EntityChoiceField;
use Symfony\Component\Form\TextareaField;
use Symfony\Component\Form\CheckboxField;

class QuickForm extends Form {

  /**
   * @validation:MaxLength(limit=1000),
   * @validation:AssertType("string")
   * @var string
   */
  public $text;
  public function configure() {
    $this->add(new TextareaField('text'));
  }

}