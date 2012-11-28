<?
class paging {

  var $total_num; // 총 list 번호
  var $curr_page; // 현재 번호
  var $list_num; // 출력 갯수
  var $block_num; // page block Number
  var $total_page; // 총페이지 갯수
  var $img_use = 0; // 버튼 이미지 사용 유무 (0:사용 안함 / 1:사용함)
  var $block_use = 0; // 페이지 블럭 사용 유무 (0:사용 안함 / 1:사용함)
  var $baseurl; // 추가 될 URL
  var $etcurl; // 추가 될 URL
  var $prev_img; // 이전 image src
  var $next_img; // 다음 image src

//  var $first_img; // 처음 image src
//  var $last_img; // 마지막 image src

    // 이미지 사용 함수 input : 이전 image src, 다음 image src, 처음 image src, 마지막 image src
    function use_img($prev_img, $next_img) {
      $this -> img_use = 1;
      $this -> prev_img = $prev_img;
      $this -> next_img = $next_img;
//      $this -> first_img = $first_img;
//      $this -> last_img = $last_img;
    }

    // 블럭 사용 함수 input : block_num
    function use_block( $block_num ) { // 블럭할 갯수를 넣어줍니다.
      $this -> block_use = 1;
      $this -> block_num = $block_num;
    }

    // 총페이지 수 개산
    function get_totalpage() {
      $this -> total_page = ceil($this -> total_num / $this -> list_num);
    }

    // 초기 ENV 환경을 가져오는 함수
    function get_env($total_num, $list_num, $curr_page, $baseurl, $etcurl) {
      $this -> total_num = $total_num;
      $this -> list_num = $list_num;
      $this -> curr_page = $curr_page;
      $this -> baseurl = $baseurl;
      $this -> etcurl = $etcurl;
    }

    function get_startpage() {
      if ($this -> block_use) {
        return floor(($this -> curr_page  - 1)/ $this -> block_num) * $this -> block_num + 1;
      }
      else
        return 1;
    }

    function get_lastpage($s_num) {
      if ($this -> block_use) {
        $last_num = ($s_num + $this -> block_num -1) > $this -> total_page ? $this -> total_page : ($s_num + $this -> block_num - 1);
        return $last_num;
      }
      else
        return $this -> total_page;
    }

    // url 만들기
    function mk_url_html($num) {
      if ($num != $this -> curr_page)
        return "<a href=\"".$this->baseurl."?pagenum=".$num.$this->etcurl."\">[".$num."]</a>";
      else
        return "<b>[".$num."]</b>";
    }

    function mk_prev_img() {
      if ($this -> img_use)
        return "<img src=\"".$this -> prev_img."\" border=\"0\">";
      else
        return "◀";
    }

    function mk_next_img() {
      if ($this -> img_use)
        return "<img src=\"".$this -> next_img."\" border=\"0\">";
      else
        return "▶";
    }

    function mk_object_html($num, $object) {
        return "<a href=\"".$this->baseurl."?pagenum=".$num.$this->etcurl."\">".$object."</a>";
    }

    function mk_prev_num($s_num, $c_num) {
      if ($this -> block_use) {
        if($s_num < $this -> block_num)
          return $s_num;
        else
          return $s_num - 1;
      } else {
        if ($c_num != 1)
          return $c_num - 1;
        else
          return $c_num;
      }
    }

    function mk_next_num($l_num, $c_num) {
      if ($this -> block_use) {
        if($l_num + $this -> block_num > $this -> total_page)
          return $this -> total_page;
        else
          return $l_num + 1;
      } else {
        if ($c_num < $this -> total_page)
          return $c_num + 1;
        else
          return $c_num;
      }
    }

    function mk_getstr ($get) {
      if (is_array($get)) {
        foreach($get as $k => $v) {
          if($k != "pagenum" && $k != "no") {
            if (is_array($v)) {
              for ($i = 0; $i < sizeof($v); $i++)
                $tmp .= "&".$k."[]=".urlencode(stripslashes($v[$i]));
            }
            else
              $tmp .= "&".$k."=".urlencode(stripslashes($v));
          }
        }
      }
      return $tmp;
    }

    function get_limit ($page, $num) {
      $value[1] = $num * $page;
      $value[0] = $value[1] - $num + 1;
      return $value;
    }

    function mk_numbering () {
      $this -> get_totalpage();

      $s_num = $this -> get_startpage();
      $l_num = $this -> get_lastpage($s_num);
      if ($this -> curr_page > $this -> block_num)
        $val .= $this -> mk_object_html($this -> mk_prev_num($s_num, $this->curr_page), $this -> mk_prev_img())."&nbsp;&nbsp;";
      for ($i = $s_num; $i <= $l_num; $i++) {
        if ($i == $s_num)
          $val .= $this->mk_url_html($i);
        else
          $val .= "&nbsp;·&nbsp;".$this->mk_url_html($i);
      }
      if (($this -> block_num + $s_num) <= $this -> total_page)
        $val .= "&nbsp;&nbsp;".$this -> mk_object_html($this -> mk_next_num($l_num, $this->curr_page), $this -> mk_next_img());
      return $val;
    }

}



/*
$pg = new paging;
$page = $_GET[page] == "" ? '1' : $_GET[page];
$list_num = 20;
$limit_num = $pg -> get_limit($page, $list_num);


$ecturl = $pg -> mk_getstr($_GET);
$pg -> get_env($total, $list_num, $page, $PHP_SELF, $ecturl);
$pg -> use_block('10');
$pg -> use_img('./image/btn_pre1.gif', './image/btn_next1.gif');
$no = $total - ($list_num*($page-1));

echo $pg -> mk_numbering();
*/


?>