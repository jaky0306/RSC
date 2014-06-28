<?php

class ConnDB {
    private $host = 'localhost' ;
    private $user = 'root' ;
    private $password = '123456' ;
    private $dbname = 'one' ;
    private $conn ;

    function __construct(){

        if(func_num_args()>0){
            $this->dbname = func_get_arg(0);
        }

        $this->conn = mysql_connect($this->host,$this->user,$this->password) or die('connect failed'.mysql_error()) ;
        mysql_select_db($this->dbname,$this->conn);
    }

    public function selectDB($dbName){
        mysql_select_db($dbName,$this->conn);
    }

    public function selectSet($select){
        return mysql_query($select,$this->conn);
    }

    public function selectNum($select){
        $result = mysql_query($select,$this->conn);
        return mysql_num_rows($result);
    }

    public function close(){
        mysql_close($this->conn);
    }

    public function affectSet($select){
        return mysql_query($select,$this->conn);
    }

    public function affectNum($select){
        $result = $this->affectSet($select) ;
        return  mysql_affected_rows($this->conn);
    }
}

class Log{
    private $str = '' ;
    const LOG_LEVEL_ERROR = 1 ;
    const LOG_LEVEL_WARNING = 2 ;
    const LOG_LEVEL_NOTICE = 3;
    const LOG_FILE = "PHP_LOG_%s.log" ;

    function __construct() {}

    function __destruct(){
        if($this->str!=''){
            $file = sprintf(self::LOG_FILE,date('Ymd'));
            file_put_contents($file,$this->str,FILE_APPEND);
        }
    }

    private function log($str,$lever){
        switch($lever){
            case self::LOG_LEVEL_NOTICE :
                $this->str .= '['.date("Y-m-d H:i:s").'] Notice : '.$str."\n" ;break ;
            case self::LOG_LEVEL_WARNING :
                $this->str .= '['.date("Y-m-d H:i:s").'] Warning : '.$str."\n" ;break ;
            case self::LOG_LEVEL_ERROR :
                $this->str .= '['.date("Y-m-d H:i:s").'] Error : '.$str."\n" ;break ;
        }
    }

    function notice($str){
        $this->log($str,self::LOG_LEVEL_NOTICE);
    }

    function warning($str){
        $this->log($str,self::LOG_LEVEL_WARNING);
    }

    function error($str){
        $this->log($str,self::LOG_LEVEL_ERROR);
    }

}