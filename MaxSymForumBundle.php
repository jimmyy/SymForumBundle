<?php

namespace Max\SymForumBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MaxSymForumBundle extends Bundle {

  public function curPageURL() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] == "on") {
      $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
      $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
  }

  public function boot() {
//    $em = $this->container->get('doctrine.orm.entity_manager');
//    $stat = new \Max\SymForumBundle\Entity\Stat();
//
//    $stat->setIp($_SERVER['REMOTE_ADDR']);
//    $stat->setAgent($_SERVER['HTTP_USER_AGENT']);
//    $stat->setUrl($this->curPageURL());
//    $stat->setDate(time());
//    $em->persist($stat);
//    $em->flush();
  }
}
