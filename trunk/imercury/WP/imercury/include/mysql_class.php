<?

class db_mysql{

  var $HOST;            //서버주소
  var $USER;            //사용자명
  var $PASS;            //패스워드
  var $DNS;             //디비네임
  var $db;              //디비접속
  var $log_chk = true;  //로그남기는지 여부 true:로그기록, false:로그기록안함
  var $log_file;        //로그파일
  var $debug = false;    //에러메세지 출력여부
  var $MicroTsmp;
  var $START_TIME;
  var $FINISH_TIME;
  var $EXCUTE_TIME;



  function con(){          // 디비 접속
    if($db = @mysql_connect($this -> HOST,$this -> USER,$this -> PASS)){
      if(!mysql_select_db($this -> DNS,$db)) $this -> err_log();
	  $this->set_character( "utf8" );
    }else{
      $this -> err_log();
    }
  }

  function err_log(){         // 에러시 작동
    $errno=mysql_errno();
    $error= mysql_error();

    if($this -> log_chk){
      $flog = @fopen($this->log_file, "a+");
      $date = date("Y-m-d H:i:s");
      $err_str = "[".$date."] ".$_SERVER[REQUEST_URI]." | SQL : ".$errno." | ".$error."\n";
      @fwrite($flog, $err_str);
      @fclose($flog);
    }
    if($this -> debug){
      echo("에러코드 $errno : $error");
    }

    echo ("
      <script language=JavaScript>
		  alert('sql 에러');
		  </script>");

    exit;
  }

  function start_time($msg,$sql){
   if($this->debug) {
      echo $msg.":".$sql."<br>";
      $this -> MicroTsmp = split(" ",microtime());
      $this -> START_TIME = $this -> MicroTsmp[0]+$this -> MicroTsmp[1];
    }
  }

  function end_time(){
    if($this->debug) {
      $this -> MicroTsmp = split(" ",microtime());
      $this -> FINISH_TIME = $this -> MicroTsmp[0]+$this -> MicroTsmp[1];
      $this -> EXCUTE_TIME = $this -> FINISH_TIME - $this -> START_TIME;
      echo "실행시간 : ".$this -> EXCUTE_TIME."<br>";
    }
  }

	function set_character( $as_CharacterCode )
	{
		$this->execute( "set character_set_connection=".$as_CharacterCode );
		$this->execute( "set character_set_server=".$as_CharacterCode );
		$this->execute( "set character_set_client=".$as_CharacterCode );
		$this->execute( "set character_set_results=".$as_CharacterCode );
		$this->execute( "set character_set_database=".$as_CharacterCode );
	}

######  select query  ###################################################################

  function querys($sql){     // 여러행의 필드를 불러올때. 2차배열로 반환
    $this -> start_time("Querys",$sql);
    if(!$result = @mysql_query($sql)) $this -> err_log();

    $k = 0;
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
      foreach($row as $i => $value){
        $info[$k]["$i"] = $value;
      }
    $k++;
    }
    $this -> end_time();
    return $info;
  }


  function query_one($sql){    // 단 하나의 값을 가질 경우.
    $this -> start_time("Query_one",$sql);
    if(!$result = @mysql_query($sql)) $this -> err_log();

    $info = @mysql_result($result,0);

    $this -> end_time();
    return $info;
  }

  function query($sql){  // 한행을 불러올때. 1차 배열로 반환
    $this -> start_time("Query",$sql);
    if(!$result = @mysql_query($sql)) $this -> err_log();
     $num = mysql_num_rows($result);
    if($num > 0){
    $row = mysql_fetch_array($result, MYSQL_ASSOC);

      foreach($row as $i => $value){
        $info["$i"] = $value;
      }
    }



    $this -> end_time();
    return $info;
  }

  function counts($sql){
    $this -> start_time("Counts",$sql);
    if(!$result = @mysql_query($sql)) $this -> err_log();
    $info = mysql_num_rows($result);

     $this -> end_time();
    return $info;
  }

  function query_between($sql,$start,$end){
    $this -> start_time("Query_between",$sql." limit ".$start.", ".$end);
    $start = $start -1;
    if(!$result = @mysql_query($sql." limit ".$start.", ".$end)) $this -> err_log();
    $k = 0;
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
      foreach($row as $i => $value){
        $info[$k]["$i"] = $value;
      }
    $k++;
    }

     $this -> end_time();
    return $info;
  }
#########################################################################################



######  execute query  ##################################################################

  function execute($sql){
    $this -> start_time("Execute",$sql);
    if(!$result = @mysql_query($sql)) $this -> err_log();
    $this -> end_time();
  }

#########################################################################################


}

?>