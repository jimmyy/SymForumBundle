<?php

namespace Max\SymForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Max\SymForumBundle\Entity\Post as Post;

class AdminController extends Controller {

  /**
   * @extra:Route("/", name="_admin")
   * @extra:Template()
   */
  public function indexAction() {
    $em = $this->get('doctrine.orm.entity_manager');
    $manager = $this->getManagerAction($em);
    return $this->render('MaxSymForum:Admin:index.html.twig',array('name' => $manager->getName()));
  }

  /**
   * @extra:Route("/new/type", name="_admin_new_type")
   * @extra:Template()
   */
  public function typeCreateAction($name) {
    $em = $this->get('doctrine.orm.entity_manager');
    $form = \Max\SymForumBundle\Form\TypeForm::create($this->get('form.context'), 'type');
    $form->bind($this->get('request'), $form);
    if ($form->isValid()) {
      $entity = new \Max\SymForumBundle\Entity\Type();
      $entity->setName($form->name);
      $entity->setDescription($form->description);
      $entity->setHide($form->hide);
      $em->persist($entity);
      $em->flush();
      $this->get('session')->setFlash('notice', 'Type sent!');
      // return new RedirectResponse($this->generateUrl('_symforum',array('page'=>0)));
    }
    return $this->render('MaxSymForum:Default:form.html.twig', array(
        'form' => $form,
        'name' => $name
    ));
  }

  /**
   * @extra:Route("/new/subject", name="_admin_new_subject")
   * @extra:Template()
   */
  public function subjectCreateAction() {
    $em = $this->get('doctrine.orm.entity_manager');
    $manager = $this->getManagerAction($em);
    $name = $manager->getName();
    
    $form = \Max\SymForumBundle\Form\SubjectForm::create($this->get('form.context'), 'subject', array('em' => $em));
    $form->bind($this->get('request'), $form);
    // If the form has been submitted and is valid...
    if ($form->isValid()) {
      // action
      /*
      $entity = new \Max\SymForumBundle\Entity\Manager();
      $entity->setName("symforum");
      $entity->setDescription("symforum");
      $entity->setCreatedAt(new \DateTime());
      $entity->setUpdatedAt(new \DateTime());
      $em->persist($entity);
      $em->flush();*/
      $manager = $em->getRepository('Max\SymForumBundle\Entity\Manager')->findOneBy(array('name' => $name));
      $entity = new \Max\SymForumBundle\Entity\Subject();
      $entity->setManager($manager);
      //$entity->setType($form->type);
      //$entity->setParent($form->parent);
      $entity->setTitle($form->title);
      $entity->setDescription($form->description);
      $entity->setMenu($form->menu);
      $entity->setHide($form->hide);
      $em->persist($entity);
      $em->flush();
      $this->get('session')->setFlash('notice', 'Subject sent!');
      // return new RedirectResponse($this->generateUrl('_symforum',array('page'=>0)));
    }
    return $this->render('MaxSymForum:Default:form.html.twig', array(
        'form' => $form,
        'name' => $manager->getName()
    ));
  }

  /**
   * @extra:Route("/new/post", name="_admin_new_post")
   * @extra:Template()
   */
  public function postCreateAction() {
    $em = $this->get('doctrine.orm.entity_manager');
    $manager = $this->getManagerAction($em);
    $name = $manager->getName();
    $form = \Max\SymForumBundle\Form\PostForm::create($this->get('form.context'), 'post', array('em' => $em,'name'=>$name));
    $form->bind($this->get('request'), $form);
    // If the form has been submitted and is valid...
    if ($form->isValid()) {
      // action
      $entity = new \Max\SymForumBundle\Entity\Post();
      $entity->setSubject($form->subject);
      $entity->setText($form->text);
      $entity->setHide($form->hide);
      $em->persist($entity);
      $em->flush();
      $this->get('session')->setFlash('notice', 'Post sent!');
      // return new RedirectResponse($this->generateUrl('_symforum',array('page'=>0)));
    }
    return $this->render('MaxSymForum:Default:form.html.twig', array(
        'form' => $form,
        'name' => $name
    ));
  }

  /**
   * @extra:Route("/new/menu", name="_admin_new_menu")
   * @extra:Template()
   */
  public function menuCreateAction() {
    $em = $this->get('doctrine.orm.entity_manager');
    $form = \Max\SymForumBundle\Form\MenuForm::create($this->get('form.context'), 'menu');
    $form->bind($this->get('request'), $form);
    // If the form has been submitted and is valid...
    if ($form->isValid()) {
      // action
      $entity = new \Max\SymForumBundle\Entity\Menu();
      $entity->setType($form->type);
      $entity->setValue($form->value);
      $entity->setDescription($form->description);
      $entity->sethide($form->hide);
      $em->persist($entity);
      $em->flush();
      $this->get('session')->setFlash('notice', 'Menu item create!');
      // return new RedirectResponse($this->generateUrl('_symforum',array('page'=>0)));
    }
    return $this->render('MaxSymForum:Default:form.html.twig', array(
        'form' => $form
    ));
  }

  /**
   * @extra:Route("/posts", name="_admin_posts")
   * @extra:Template()
   */
  public function postsAction() {
    $em = $this->get('doctrine.orm.entity_manager');
    $manager = $this->getManagerAction($em);
    $name = $manager->getName();
    
    $q = $em->createQuery('SELECT p.id, s.title, p.text
      FROM MaxSymForum:Post as p
      LEFT JOIN p.subject as s
      LEFT JOIN s.manager as m WHERE m.name=:name');
    $q->setParameter('name', $name);
    $results = $q->getResult();
    return $this->render('MaxSymForum:Admin:posts.html.twig', array(
        'count'  => count($results),
        'entity' => $results,
        'name'   => $name
    ));
  }
  
  /**
   * @extra:Route("/subjects", name="_admin_subjects")
   * @extra:Template()
   */
  public function subjectsAction() {
    $em = $this->get('doctrine.orm.entity_manager');
    $manager = $this->getManagerAction($em);
    $name = $manager->getName();
    
    $q = $em->createQuery('SELECT s.id, s.title, m.name
      FROM MaxSymForum:Subject as s
      LEFT JOIN s.manager as m
      LEFT JOIN s.type as t
      WHERE m.name=:name');
    $q->setParameter('name', $name);
    $results = $q->getResult();
    return $this->render('MaxSymForum:Admin:subjects.html.twig', array(
        'count' => count($results),
        'entity' => $results,
        'name' => $name
    ));
  }

  /**
   * @extra:Route("/types", name="_admin_types")
   * @extra:Template()
   */
  public function typesAction($name) {
    $em = $this->get('doctrine.orm.entity_manager');
    $q = $em->createQuery('SELECT a.id, a.name FROM MaxSymForum:Type as a');
    $results = $q->getResult();
    return $this->render('MaxSymForum:Admin:types.html.twig', array(
        'count' => count($results),
        'entity' => $results,
        'name' => $name
    ));
  }
  
  /**
   * @extra:Route("/{name}/menu", name="_admin_menu")
   * @extra:Template()
   */
  public function menuAction($name) {
    $em = $this->get('doctrine.orm.entity_manager');
    $q = $em->createQuery('SELECT a.id FROM MaxSymForum:Menu as a');
    $results = $q->getResult();
    return $this->render('MaxSymForum:Admin:menu.html.twig', array(
        'count' => count($results),
        'entity' => $results,
        'name' => $name
    ));
  }

  /**
   * @extra:Route("/stats", name="_admin_stats")
   * @extra:Template()
   */
  public function statsAction($name) {
    $em = $this->get('doctrine.orm.entity_manager');
    $q = $em->createQuery('SELECT a.id, a.ip, a.agent, a.url FROM MaxSymForum:Stat as a');
    $results = $q->getResult();
    return $this->render('MaxSymForum:Admin:stats.html.twig', array(
        'count' => count($results),
        'entity' => $results,
        'name' => $name
    ));
  }

  /**
   * @extra:Route("/edit/{entity}/{id}", name="_admin_edit")
   * @extra:Template()
   */
  public function editAction($id,$entity) {
    $em = $this->get('doctrine.orm.entity_manager');
    $post = $em->getRepository($entity)->findOneBy(array('id' => $id));
    $em->remove($post);
    $em->flush();
    $this->get('session')->setFlash('notice', $entity.' '.$id.' deleted!');
    return $this->postsAction();
  }

  /**
   * @extra:Route("/delete/{entity}/{id}", name="_admin_delete")
   * @extra:Template()
   */
  public function deleteAction($id,$entity) {
    $em = $this->get('doctrine.orm.entity_manager');
    $post = $em->getRepository($entity)->findOneBy(array('id' => $id));
    $em->remove($post);
    $em->flush();
    $this->get('session')->setFlash('notice', $entity.' '.$id.' deleted!');
    return $this->postsAction();
  }

  /**
   * @extra:Route("/admininfo", name="admininfo")
   * @extra:Template()
   */
  public function adminInfoAction() {

    return $this->render('MaxSymForum:Admin:admininfo.html.twig', array(
        'name'      => $_SERVER['SERVER_NAME'],
        'software'  => $_SERVER['SERVER_SOFTWARE'],
        'path'      => $_SERVER['DOCUMENT_ROOT'],
        'ip'        => $_SERVER['REMOTE_ADDR'],
        'port'      => $_SERVER['SERVER_PORT'],
        'protocol'  => $_SERVER['SERVER_PROTOCOL'],
        'agent'     => $_SERVER['HTTP_USER_AGENT'],
        'signature' => $_SERVER['SERVER_SIGNATURE']
    ));
  }

  /**
   * @extra:Route("/databaseinfo", name="databaseinfo")
   * @extra:Template()
   */
  public function databaseInfoAction() {
    $config = new Configuration;
    return $this->render('MaxSymForum:Admin:databaseinfo.html.twig', array(
        'driver' => $config->getMetadataDriverImpl(),
    ));
  }

  static public function getManagerAction($em) {
    $manager = $em->getRepository('Max\SymForumBundle\Entity\Manager')->find(1);
    if (!$manager) {echo 'Manager not found';exit();}
    return $manager;
  }

  /**
   * @extra:Route("/phpinfo", name="phpinfo")
   * @extra:Template()
   */
  public function phpInfoAction() {
    echo phpinfo();
    exit();
  }

}
