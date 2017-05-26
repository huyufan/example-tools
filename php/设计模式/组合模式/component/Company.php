<?php

abstract class Company{
    
    protected $name;
    function __construct($name){
        $this->name=$name;
    }
    abstract function Add(Company $company);
    abstract function Remove(Company $company);
    abstract function Display($depth);
}