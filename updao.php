<?php

    include 'ConnDB.php' ;
    $mysql = new ConnDB('pxscj');
    $mysql->selectSet('set names utf8');

//["XM","XB","CSSJ","ZY","ZXF","BZ","ZP","XH"] ;
    $xh = $_POST['XH'];
    $xb = $_POST['XB'];
    $cssj = $_POST['CSSJ'];
    $zy = $_POST['ZY'];
    $bz = $_POST['BZ'];
    $xm = $_POST['XM'];
    $zxf = $_POST['ZXF'];

    $query = "update xsb set XB = $xb , CSSJ = '$cssj' ,ZY = '$zy' , BZ = '$bz' , XM = '$xm' ,ZXF = $zxf where XH = '$xh'" ;
    $num = $mysql->affectNum($query);

    echo $num ;
?>