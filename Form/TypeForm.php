<?php

namespace Max\SymForumBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\TextareaField;
use Symfony\Component\Form\CheckboxField;

class TypeForm extends Form {

  public $name;
  public $description;
  public $hide;

  public function configure() {
    $this->add(new TextField('name'));
    $this->add(new TextareaField('description'));
    $this->add(new CheckboxField('hide'));
  }

}