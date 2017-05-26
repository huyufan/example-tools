<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author admin
 */
class Product {
   public $products=array();
   public function add($name,$vale){
       $this->products[$name]=$vale;
   }
   public function showClient(){
       foreach ($this->products as $key => $v) {  
            echo $key , '=' , $v ,'<br>';  
        }  
   }
}
