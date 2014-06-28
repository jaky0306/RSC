<?php

    include 'ConnDB.php' ;
    $mysql = new ConnDB('pxscj');
    $mysql->selectSet('set names utf8');
    $re = $mysql->selectSet("select * from xsb where XM like '%王%'");
    while($fetch = mysql_fetch_array($re,MYSQL_ASSOC)){
        print_r($fetch);
    }
?>