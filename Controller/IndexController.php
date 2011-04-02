<?php

namespace Max\SymForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller {

  public function registerAction($name) {
    $em = $this->get('doctrine.orm.entity_manager');
    $form = \Max\SymForumBundle\Form\RegisterForm::create($this->get('form.context'), 'register');
    $form->bind($this->get('request'), $form);
    // If the form has been submitted and is valid...
    if ($form->isValid()) {
      // action
      $entity = new \Max\SymForumBundle\Entity\Manager();
      $entity->setName($form->title);
      $entity->setDescription($form->description);
      $entity->setHide($form->hide);
      $em->persist($entity);
      $em->flush();
      $this->get('session')->setFlash('notice', 'Type sent!');
      // return new RedirectResponse($this->generateUrl('_symforum',array('page'=>0)));
    }
    return $this->render('MaxSymForum:Index:form.html.twig', array(
        'form' => $form,
        'name' => $name
    ));
  }
}