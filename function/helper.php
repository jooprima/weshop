<?php

define("BASE_URL", "http://localhost/wegodev/weshop/");

function rupiah($nilai=0){
    $string = "Rp," . number_format($nilai);
    return $string;
}