<?php
function __autoload($class){
    require_once $class.'.php';
}
$root=new SubCompany("北京总公司");  
$root->Add(new MoneyDept("总公司财务部"));  
$root->Add(new TechnologyDept("总公司技术部"));  
//
//$shanghai=new SubCompany("上海分公司");  
//$shanghai->Add(new TechnologyDept("上海分公司技术部"));  
//$shanghai->Add(new MoneyDept("上海分公司财务部"));  
// 
//$changsha=new SubCompany("长沙分公司");  
//$changsha->Add(new TechnologyDept("长沙分公司技术部"));  
//$changsha->Add(new MoneyDept("长沙分公司财务部"));  
//
//$loudi=new SubCompany("娄底分公司");  
//$loudi->Add(new TechnologyDept("娄底分公司技术部"));  
//$loudi->Add(new MoneyDept("娄底分公司财务部"));  
//$changsha->add($loudi);
//$root->Add($shanghai);  
//$root->Add($changsha);   
$root->Display(1); 

