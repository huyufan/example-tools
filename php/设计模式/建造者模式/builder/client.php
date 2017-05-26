<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of client
 *
 * @author admin
 */
function __autoload($class){
    require_once $class.".php";
}
class client {
   
  public function buy($type){
      $director=new DirectorCashier();
      $class=new ReflectionClass("Concreate".$type);
      $concreteBuilder  = $class->newInstanceArgs();
      $director->builderFood($concreteBuilder);
      $concreteBuilder->getProduct()->showClient();  
  }
}
 $c = new Client();  
 $c->buy('a');
