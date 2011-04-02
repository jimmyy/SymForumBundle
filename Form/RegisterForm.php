<?php

namespace Max\SymForumBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\EntityChoiceField;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\CheckboxField;

class RegisterForm extends Form {

  public $title,$username,$password,$password_again,$hide;

  public function configure() {
    $this->add(new TextField('title'));
    $this->add(new TextField('username'));
    $this->add(new TextField('password'));
    $this->add(new TextField('password_again'));
    $this->add(new CheckboxField('hide'));
  }

}