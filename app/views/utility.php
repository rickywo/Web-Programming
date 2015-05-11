<?php

function checkVoucherCode($v){
    $tok = explode("-",$v);
    $arr1 = str_split($tok[0]);
    $arr2 = str_split($tok[1]);
    $arr3 = str_split($tok[2]);
    $chsum1 = (($arr1[0]*$arr1[1]+$arr1[2])*$arr1[3]+$arr1[4])%26;
    $chsum2 = (($arr2[0]*$arr2[1]+$arr2[2])*$arr2[3]+$arr2[4])%26;
    return $arr3[0] === chr($chsum1 + 65) && $arr3[1] === chr($chsum2 + 65) ? true : false;
}
