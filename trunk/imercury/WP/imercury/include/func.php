<?
$config_dir = $DOCUMENT_ROOT;
$post->post_name = '/'.$post->post_name;	//게시판 등에서 활용하기 위해

function err_back($msg){
  echo("
  <script>
    alert('$msg');
    history.back();
  </script>
  ");
  exit;
}

function err_move($msg,$url){
  echo("
  <script>
    alert('$msg');
    location.href = '$url';
  </script>
  ");
  exit;
}
function move_to($url){
  echo("
  <script>
    location.href = '$url';
  </script>
  ");
  exit;
}

function cut_string($msg, $len, $tail="...")
{
	if (isset($len) === true)
	{
		// to speed things up
		$msg = mb_substr($msg, 0, $len, 'UTF-8');

		if($len >= strlen($msg))
			return $msg;

		while (strlen($msg) > $len)
		{
			$msg = mb_substr($msg, 0, -1, 'UTF-8');
		}
		$msg.= $tail;
	}

	return $msg;

	/*
		if($len >= strlen($msg)) {
			return $msg;
		}
		$klen = $len - 1;
		while(ord($msg[$klen]) & 0x80) {
			$klen--;
		}
		return substr($msg, 0, $len - (($len + $klen + 1) % 2)) . $tail;
	*/
}

/*
function get_post($exception = "",$view = "false"){

  $ex = explode("|",$exception);
  $count = count($ex);

  if($count > 0){
    for($i=0;$i<$count;$i++){
      $ext[$i+1] = $ex[$i];
    }
  }

  foreach($_GET as $a => $b){
    if($count > 0){
      $chk = array_search($a,$ext);
      if(!$chk){
        $info .= "&".$a."=".$b;
        if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
      }
    }else{
      $info .= "&".$a."=".$b;
      if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
    }
  }

  foreach($_POST as $a => $b){
    if($count > 0){
      $chk = array_search($a,$ext);
      if(!$chk){
        $info .= "&".$a."=".$b;
        if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
      }
    }else{
      $info .= "&".$a."=".$b;
      if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
    }
  }

  return $info;
}
*/

function find_replace($word,$search,$color= "#FF0000"){
  $info = str_replace($search,"<font color='$color'>$search</font>",$word);
  return $info;
}

// 테이블 유효성 검사---
function istable($str, $dbname='') {
  global $config_dir;
	if(!$dbname) {
	$f=@file($config_dir."config.php") or err_move("config.php파일이 없습니다.<br>DB설정을 먼저 하십시요","setup.php");
	for($i=1;$i<=4;$i++) $f[$i]=str_replace("\n","",$f[$i]);
	  $dbname=$f[4];
  }
	$result = mysql_list_tables($dbname) or error(mysql_error(),"");
	$i=0;

  while ($i < mysql_num_rows($result)) {
	  if($str==mysql_tablename ($result, $i)) return 1;
		$i++;
	}
	return 0;
}
//--------------------------

function showText($string){
# global $string;
	$c_text = $string;
	$c_text = stripslashes($c_text);

	if (! eregi("a href", $c_text) && ! eregi("src", $c_text))
	{
		if (eregi("http://", $c_text)):
			$c_text = eregi_replace( "http://([a-z0-9\_\-\./~@?=%&amp;]+)",
                                   " <a href=\"http://\\1\" TARGET=\"_BLANK\">http://\\1</a> ",
                                   $c_text);
		endif;

		if (eregi("ftp://", $c_text)):
			$c_text = eregi_replace( "ftp://([a-z0-9\_\-\./~@?=%&amp;]+)",
                                   " <a href=\"ftp://\\1\" TARGET=\"_BLANK\">ftp://\\1</a> ",
                                   $c_text);
		endif;

		if (eregi("telnet://", $c_text)):
			$c_text = eregi_replace( "telnet://([a-z0-9\_\-\./~@?=%&amp;]+)",
                                   " <a href=\"telnet://\\1\" TARGET=\"_BLANK\">telnet://\\1</a> ",
                                   $c_text);
		endif;

		if (eregi("news://", $c_text)):
			$c_text = eregi_replace( "news://([a-z0-9\_\-\./~@?=%&amp;]+)",
                                   " <a href=\"news://\\1\" TARGET=\"_BLANK\">news://\\1</a> ",
                                   $c_text);
		endif;

		if (eregi("gopher://", $c_text)):
			$c_text = eregi_replace( "gopher://([a-z0-9\_\-\./~@?=%&amp;]+)",
                                   " <a href=\"gopher://\\1\" TARGET=\"_BLANK\">gopher://\\1</a> ",
                                   $c_text);
		endif;

			$c_text = eregi_replace( "([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)",
                               " <a href=\"mailto:\\1@\\2\">\\1@\\2</a> ",
                               $c_text);
		}


		if (! eregi("&lt;?table", $c_text) && ! eregi("&lt;?Table", $c_text) && ! eregi("&lt;?TABLE", $c_text) && ! eregi("<table", $c_text) && ! eregi("<Table", $c_text) && ! eregi("<TABLE", $c_text))
		{

			$c_text = eregi_replace("\t","        ",$c_text);
			$c_text = eregi_replace("^ ","&nbsp;",$c_text);
			$c_text = eregi_replace("  "," &nbsp;",$c_text);

			$c_text = eregi_replace("\r\n","<br>",$c_text);
			$c_text = eregi_replace("\n","<br>",$c_text);
			$c_text = eregi_replace("\r\n\r\n","<p>",$c_text);
		}

	$string = $c_text;
	return $string;
}


function image_re($img,$w=0,$h=0){
  $img_size=@GetImageSize("$img");

  $width = $img_size[0];
  $height = $img_size[1];

  if($img_size[0] > $w){
    $height = ($w * $height)/$width;
    $width = $w;
  }

  if($height > $h){
    $width = ($h * $width)/$height;
    $height = $h;
  }

  $value[0] = $img;
  $value[1] = $width;
  $value[2] = $height;
  return $value;
}


function upload_file($file,$dir,$chk=0,$f_name="",$s=""){
  $img = explode(".",$file[name]);
  $count = count($img)-1;
  if($chk == 0){
    if($s) $filename = time()."_".$s.".".$img[$count];
  	else $filename = time().".".$img[$count];
  }else if($chk == 1){
    $filename = $file[name];
  }else if($chk == 2){
    $filename = $f_name.".".$img[$count];
  }

    echo $file[tmp_name].":".$dir."/".$filename;

  if(!copy($file[tmp_name],$dir."/".$filename)){
    echo "파일 업로드 실패";
    exit;
  }
  return $filename;
}

function upload_file2($file,$dir,$chk=0,$f_name="",$s=""){
  $img = explode(".",$file[name]);
  $count = count($img)-1;
  if($chk == 0){
    if($s) $filename = time()."_".$s.".".$img[$count];
  	else $filename = time().".".$img[$count];
  }else if($chk == 1){
    $filename = $file[name];
  }else if($chk == 2){
    $filename = $f_name.".".$img[$count];
  }

    echo $file[tmp_name].":".$dir."/".$filename;

  if(!copy($file[tmp_name],$dir."/".$filename)){
    echo "파일 업로드 실패";
    exit;
  }
  return $filename;
}

function member($id,$db){
  $sql = "select * from member_tbl where userid = '$id'";
  $info = $db -> query($sql);
  return $info;
}

function admin($db){
  $sql = "select * from member_tbl where level = '1'";
  $info = $db -> query($sql);
  return $info;
}

function b_admin($id,$db){
  $sql = "select * from board_admin where name = '$id'";
  $info = $db -> query($sql);
  return $info;
}

function board($id,$no,$db){
  $sql = "select * from $id where no = '$no'";
  $info = $db -> query($sql);
  return $info;
}

function site($db){
  $sql = "select * from site_tbl";
  $info = $db -> query($sql);
  return $info;
}

function category($id,$db){
  $cate_table = "w_cate_".$id;
  $sql = "select * from $cate_table order by num";
  $info = $db -> querys($sql);
  return $info;
}

function mail_ch($text,$id,$db){
  $m = member($id,$db);
  $s = site($db);

    $add = "우)".$m[zip1]."-".$m[zip2]." ".$m[addr1]." ".$m[addr2];
    $text = str_replace("__USER_NAME__",$m[name],$text);
    $text = str_replace("__USER_ID__",$m[userid],$text);
    $text = str_replace("__USER_PASSWD__",$m[pwd],$text);
    $text = str_replace("__USER_JUMIN__",$m[jumin1]."-".$info[jumin2],$text);
    $text = str_replace("__USER_EMAIL__",$m[email],$text);
    $text = str_replace("__USER_TEL__",$m[tel],$text);
    $text = str_replace("__USER_ADDRESS__",$add,$text);

    $text = str_replace("__SITE_DOMAIN__","http://".$_SERVER['HTTP_HOST'],$text);
    $text = str_replace("__SITE_NAME__",$s[s_name],$text);
    $text = str_replace("__SITE_CEO__",$s[s_ceo],$text);
    $text = str_replace("__SITE_TEL__",$s[s_tel],$text);
    $text = str_replace("__SITE_EMAIL__",$s[s_email],$text);
    $text = str_replace("__SITE_ADDRESS__",$s[s_addr],$text);

  return $text;
}

function limit_board($H,$id,$limit,$skin,$width,$db){
  include $H."/skin2/".$skin."/setup.html";
  include $H."/skin2/".$skin."/list_head.html";
  $b_admin = b_admin($id,$db);
  $today = date("YmdHis",strtotime("-".$new_day." day"));
  $board_tb = "w_".$id;
  $sql = "select * from $board_tb order by rdate desc limit $limit";
  $info = $db -> querys($sql);
  if(count($info) == 0) include $H."/skin2/".$skin."/list_null.html";
  else{
    for($i=0;$i<count($info);$i++){
      $date = substr($info[$i][rdate],4,2)."/".substr($info[$i][rdate],6,2);
      $title = cut_string($info[$i][title],$max_length);
      if($new_view == 1){
        if($today <= $info[$i][rdate]) $new = "<img src='/skin2/".$skin."/img/".$new_icon."' border='0'>";
        else $new = "";
      }
      if($b_admin[view_list] == "y") $title = "<a href='/board/board.php?id=$id&no=".$info[$i][no]."'>".$title."</a>";
      else $title = "<a href='/board/view.php?id=$id&no=".$info[$i][no]."'>".$title."</a>";

      include $H."/skin2/".$skin."/list_main.html";
    }
  }
  include $H."/skin2/".$skin."/list_foot.html";


}


function mail_send($name,$email,$no,$id,$db){
  $sql = "select title, html_yn, contents from mail_base where no = '$no'";
  $info = $db -> query($sql);

  $sql = "select s_name,s_email from site_tbl";
  $admin = $db -> query($sql);
  $from_email = $admin[s_email];
  $from_name = $admin[s_name];

  $TO = $name."<".$email.">";

  $header = "Return-Path: $from_email;\r\n";
  $header .= "From: $from_name <$from_email>\n";
  $header .= "Content-Type: text/html; charset=euc-kr\n" ;
  $header .= "Content-Transfer-Encoding : 8bit\n";


  $title = mail_ch($info[title],$id,$db);
  $text = mail_ch($info[contents],$id,$db);
  $text = stripslashes($text);

  if($info[html_yn] == "y"){
    $text = $text;
  }else{
    $text = nl2br(htmlspecialchars($text));
  }

   mail($TO, $title , $text , $header);
}

function auth_chked($type){
	//회원 체크+제품인증
	if($type == 3){
		if($_COOKIE["admin_lever"] == '0'){
			return true;
		}else{
			return false;
		}
	}

}


function auth_chk($type){

	//회원 체크+제품인증
	if($type == 2){

		global $db;

		$query2 = "select * from good_reg left outer join model_tbl on good_reg.model_no =model_tbl.no where userid = '".$_COOKIE["mid"]."' " ;
		$info2 = $db->query($query2);

		if($_COOKIE["mid"] && $info2[mname]){
			return true;
		}else{
			return false;
		}
				// 관리자 권한체크
	}else if($type == 3){

		if($_COOKIE["admin_lever"] == '1'){
			return false;
		}else{
			return true;
		}

	} else { //회원 체크

		if($_COOKIE["mid"]){
			return true;
		}else{
			return false;
		}

	}
}
?>