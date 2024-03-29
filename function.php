function replace_str($arrAttribute=array(),$text=null){
    if(!function_exists('utf8_strrev')){
      function utf8_strrev($str){
        preg_match_all('/./us', $str, $ar);
        return join('', array_reverse($ar[0]));
      }
    }if(!function_exists('groupArray')){
      function groupArray($group,$attribute,$text,$txt){
        foreach ($group as $arr) {
          foreach ($arr as $value) {
            foreach($arr as $key => $value){
              if(!stristr($text, $value) === FALSE){
                $str = $arr[$key];
                for($i=0;$i<count($arr);$i++){
                  for($s=0;$s<=substr_count($text,$value);$s++){
                    $txt .= $attribute.' LIKE "%'.preg_replace('/'.preg_quote($str, '/').'/', $arr[$i], $text, $s).'~=';
                  }
                }for($i=0;$i<count($arr);$i++){
                  for($s=0;$s<=substr_count($text,$value);$s++){
                    $text = preg_replace('/'.preg_quote($str, '/').'/', $arr[$i], utf8_strrev($text), $s);
                    $text = utf8_strrev($text);
                    $txt .= $attribute.' LIKE "%'.$text.'~=';
                  }
                }
              }
            }
          }
          $txt = str_replace('~', '%" OR ', $txt);
        }
        return $txt;
      }
    }
    if($text && !empty($arrAttribute)){
      $group = array(array('ا','أ','آ','إ'),array('ى','ي','ئ'),array('و','ؤ'),array('ه','ة'));
      $txt = ' AND (';
      $txtEnd = ' )';
      foreach ($arrAttribute as $key => $attribute) {
        ($key == 0) ? $txt .= ' ('.$attribute.' LIKE "%'.$text.'~=' : $txt .= ' OR ('.$attribute.' LIKE "%'.$text.'~=';
        $txt = groupArray($group,$attribute,$text,$txt);
        $group = array_reverse($group);
        $txt = groupArray($group,$attribute,$text,$txt);
        $txt = str_replace(' OR = OR', ') OR', $txt);
      }
      $txt = substr(implode(' ',array_unique(explode('=',$txt))), 0, -5).')';
      return $txt.$txtEnd;
    }
  }
