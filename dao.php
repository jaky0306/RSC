<?php
    include_once 'ConnDB.php' ;
    $mysql = new ConnDB('pxscj');


//ajax查询方式获取
    $method = $_POST['method'] ;
    $goal = $_POST['goal'] ;
    $condition = $_POST['condition'];

    $mysql->selectSet('set names utf8');

    if($method == 'first'){
        $query = makeFirstQuery($goal,$condition);
        echo shiftSelectToJson($mysql,$query);

    }else if($method=='second'){
        $filter = $_POST['filter'];
        $query = makeSecondQuery($goal,$condition,$filter);
        echo shiftSelectToJson($mysql,$query);
    }else{
        $page = $_POST['page'];
        $filter = isset($_POST['filter'])?$_POST['filter']:null ;
        if($filter){
            $query = makeThirdQuery($goal,$condition,$page,$filter);
            echo shiftSelectToJson($mysql,$query);
        }else{
            $query = makeThirdQuery($goal,$condition,$page) ;
            echo shiftSelectToJson($mysql,$query);
        }

        //echo shiftSelectToJson($mysql,$query);
    }



//模糊查询
// $goal 和 $condition 是模糊查询的条件
    function makeFirstQuery($goal , $condition){
        return  "select * from xsb where $goal like '%$condition%'";
    } ;

//过滤查询
//$filter 是过滤条件

    function makeSecondQuery($goal,$condition,$filter){
        return "select * from xsb where $goal like '%$condition%' and ZY = '$filter'" ;
    } ;

//分页查询

    function makeThirdQuery($goal,$condition,$page,$filter=null){
        $offset = (int)$page * 10 ;
        if($filter == null) return  "select * from xsb where $goal like '%$condition%' limit $offset , 10" ;
        else return "select * from xsb where $goal like '%$condition%' and ZY = '$filter' limit $offset , 10" ;

    }

//系别数据查询（固定）
    function makeZYQuery(){
        return 'select distinct ZY from xsb ' ;
    };


/**
 * 将查询后的结果集转换特定格式的JSON数据
 * @param $mysql ConnDB类的实例对象
 * @param $query MYSQL 的SELECT 语句
 * @return string 返回JSON格式化后的数据
 */
function shiftSelectToJson($mysql,$query){
        $result = $mysql->selectSet($query);
        $keyHead = 'a' ;
        $num = 0 ;
        $jsonHead = '{' ;
        $jsonFoot = '}' ;

        while($arr = mysql_fetch_array($result,MYSQL_ASSOC)){
            $jsonHead .= '"'.$keyHead.$num.'":';
            $jsonHead .=  json_encode($arr,JSON_UNESCAPED_UNICODE);
            $jsonHead .= ',';
            $num++;
        }

        $jsonHead .= '"length":'.$num ;
        $jsonHead .= $jsonFoot ;
        mysql_free_result($result) ;
        return $jsonHead ;
    }

//关闭连接

    $mysql->close();


?>