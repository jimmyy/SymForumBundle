<?php

namespace Max\SymForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

  /**
   * @extra:Routes({
   *   @extra:Route("/", defaults={"page"=1}, name="_symforum_list"),
   *   @extra:Route("/{page}", name="_symforum_list_page")
   * })
   * @extra:Template()
   */
  public function listAction($page) {
    if ($page <= 0) $page = 1;
    $em = $this->get('doctrine.orm.entity_manager');
    $manager = \Max\SymForumBundle\Controller\AdminController::getManagerAction($em);
    $q = $em->createQuery('SELECT s.id, s.title, t.name
      FROM MaxSymForum:Subject as s
      LEFT JOIN s.type as t
      WHERE s.hide=false');
    $q->setFirstResult(($page - 1) * 10);
    $q->setMaxResults(10);
    // $q->setParameter('id', $id);
    return $this->render('MaxSymForum:Default:list.html.twig', array(
        'subjects' => $q->getResult(),
        'name' => $manager->getName(),
        'previous_page' => $page - 1,
        'next_page' => $page + 1,
    ));
  }

  /**
   * @extra:Routes({
   *   @extra:Route("/{name}", name="_symforum_index")
   * })
   * @extra:Template()
   */
  public function indexAction($name) {
    return $this->pageAction($name,'home',1);
  }



  public function menuAction($name) {
    $em = $this->get('doctrine.orm.entity_manager');
    $q = $em->createQuery('SELECT s.id, s.title, t.name
      FROM MaxSymForum:Subject as s
      LEFT JOIN s.manager as m
      LEFT JOIN s.type as t
      WHERE m.name=:name and s.menu=true and s.hide=false');
    $q->setParameter('name', $name);
    return $this->render('MaxSymForum:Default:menu.html.twig', array(
        'menu' => $q->getResult(),
        'name' => $name
    ));
  }
  
  public function textAction($name,$title) {
    $em = $this->get('doctrine.orm.entity_manager');
    $q = $em->createQuery("SELECT p.text
      FROM MaxSymForum:Post as p, MaxSymForum:Subject as s
      LEFT JOIN s.type as t
      LEFT JOIN s.manager as m
      WHERE p.subject=s.id and m.name=:name and t.name='text' and s.title=:title and p.hide=false");
    $q->setParameter('name', $name);
    $q->setParameter('title', $title);
    return $this->render('MaxSymForum:Default:text.html.twig', array(
        'text' => $q->getResult()
    ));
  }

  /**
   * @extra:Routes({
   *   @extra:Route("/{name}/page/{title}", defaults={"page"=1}),
   *   @extra:Route("/{name}/page/{title}/{page}", name="_symforum_page")
   * })
   * @extra:Template()
   */
  public function pageAction($name,$title,$page) {
    if ($page <= 0) $page = 1;
    $em = $this->get('doctrine.orm.entity_manager');
    $form = \Max\SymForumBundle\Form\QuickForm::create($this->get('form.context'), 'post');
    $form->bind($this->get('request'), $form);
    // If the form has been submitted and is valid...
    if ($form->isValid()) {
      $subject = $em->getRepository('Max\SymForumBundle\Entity\Subject')->findOneBy(array('title'=>$title));
      $entity = new \Max\SymForumBundle\Entity\Post();
      $entity->setSubject($subject);
      $entity->setText($form->text);
      $entity->setHide(false);
      $em->persist($entity);
      $em->flush();
      $this->get('session')->setFlash('notice', 'Post sent!');
      // return new RedirectResponse($this->generateUrl('_symforum',array('page'=>0)));
    }
    return $this->render('MaxSymForum:Default:page.html.twig', array(
        'form' => $form,
        'text'  => $this->postsAction($title, "ORDER BY s.id DESC  ",$page),
        'title' => $title,
        'name'  => $name,
        'previous_page' => $page - 1,
        'next_page' => $page + 1,
    ));
  }

  /**
   * @extra:Route("/{name}/wiki/{id}", name="_symforum_wiki")
   * @extra:Template()
   */
  public function wikiAction($title) {
    $sql = "ORDER BY id DESC LIMIT 1";
    return $this->render('MaxSymForum:Default:text.html.twig', array(
        'text' => $this->postsAction($title, $sql,1)
    ));
  }

  /**
   * @extra:Route("/{name}/blog/{id}/{page}", name="_symforum")
   * @extra:Template()
   */
  public function blogAction($page=0) {
    if ($page <= 0) $page = 1;
    return $this->render('MaxSymForumB:Default:index.html.twig', array(
        'name' => $name,
        'articles' => $this->postsAction($title, "ORDER BY s.id DESC",$page),
        'previous_page' => $page - 1,
        'next_page' => $page + 1,
    ));
  }

  public function postsAction($title,$sql,$page) {
    $em = $this->get('doctrine.orm.entity_manager');
    $q = $em->createQuery("SELECT a.text
      FROM MaxSymForum:Post as a
      LEFT JOIN a.subject as s
      WHERE s.title=:title and a.hide=false
      $sql");
    $q->setParameter('title', $title);
    $q->setFirstResult(($page - 1) * 10);
    $q->setMaxResults(10);
    return $q->getResult();
  }
}