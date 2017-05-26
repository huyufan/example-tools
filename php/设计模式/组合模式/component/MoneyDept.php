<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MoneyDept
 *
 * @author admin
 */
class MoneyDept extends Company {

    function __construct($name) {
        parent::__construct($name);
    }
    function Add(Company $company){
            echo "叶子节点，不能继续添加节点。。。。。。。。。。<br/>";  
    }
    function Remove(Company $company) {
          echo "叶子节点，不能删除节点。。。。。。。。。。<br/>";  
    }
    function Display($depth) {
       $pre="";  
        for($i=0;$i<$depth;$i++)  
        {  
            $pre.="-";  
        }  
        $pre.=$this->name."<br/>";  
        echo $pre;  
    }
}
