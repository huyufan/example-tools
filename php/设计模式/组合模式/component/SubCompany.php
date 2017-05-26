<?php

class SubCompany extends Company {

    private $sub_company = array();

    function __construct($name) {
        parent::__construct($name);
    }

    function add(Company $company) {
        $this->sub_company[] = $company;
    }

    function Remove(Company $company) {
        $key = array_search($company, $this->sub_company);
        if ($key !== false) {
            unset($this->sub_company[$key]);
        }
    }

    function Display($depth) {
        $pre = "";
        for ($i = 0; $i < $depth; $i++) {
            $pre .= "-";
        }
        $pre .= $this->name . "<br/>";
        echo $pre;
  
        foreach ($this->sub_company as $v) {
            $v->Display($depth + 2);
        }
    }

}
