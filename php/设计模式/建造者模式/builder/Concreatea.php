<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Concreatea
 *
 * @author admin
 */
class Concreatea extends Builder {
    protected  $_product=null;
    function __construct(){
        $this->_product=new Product();
    }
    /** 
     * 创建产品的第一部分::汉堡=2 
     */  
    public  function buildPart1()  
    {  
        $this->_product->add('Hamburger',2);  
    }  
    /** 
     *  
     * 创建产品的第二部分： 
     */  
    public  function buildPart2()  
    {  
        $this->_product->add('Drink', 1);  
    }  
    /** 
     * 返回产品对象 : 
     *  
     */  
    public function  getProduct()  {  
        return  $this->_product;  
    } 
}
