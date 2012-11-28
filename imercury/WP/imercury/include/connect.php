<?
require "mysql_class.php";	// db class


$date = date("Ymd");
$db = new db_mysql;
$db -> HOST	= DB_HOST;
$db -> USER	= DB_USER;
$db -> PASS	= DB_PASSWORD;
$db -> DNS	= DB_NAME;
$db -> log_file	= NEW_IMERCURY_DIR . "/db_log/".$date."_log.txt";
$db -> con();
?>