<?php

function bubble($value){
    $length= count($value)-1;
    for($j=0;$j<$length;++$j){
        for($i=0;$i<$length;++$i){
            if($value[$i+1]<$value[$i]){
                $temp=$value[$i];
                $value[$i]=$value[$i+1];
                $value[$i+1]=$temp;
            }
        }
    }
    return $value;
}

/** ÓÅ»¯ºó
*/


function bubble_better($value){
	$i=count($value)-1;
	while($i>0){
		$pos=0;
		for($j=0;$j<$i;$j++){
			if($value[$j]>$value[$j+1]){
				$pos=$j;
				$temp=$value[$j];
				$value[$j]=$value[$j+1];
				$value[$j+1]=$temp;
			}
		}
		$i=$pos;
	}
	return $value;
}