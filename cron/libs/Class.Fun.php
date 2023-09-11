<?php




//2、循环的读取目录下的所有文件
function fileList($path)
{
  
  $list = array();
  $handler = opendir($path);
  while( ($filename = readdir($handler)) !== false ) {
        if($filename != "." && $filename != ".."){
            $list[] = str_replace('.html', '', $filename);
        }
  }
  closedir($handler); 
  return $list;
}


// 修改domain成一级domain
function fix_domain_($domain, &$domain_words)
{
    $temp = array();
    $str = '';
    if (!empty($domain)) {
        $arr = explode('.', $domain);
        krsort($arr);
        foreach ($arr as $key => $value) {
            $str = '.' . $value . $str;
            if (!isset($domain_words[$value])) {
                return ltrim($str, '.');
            }
        }
    }
    return $domain;
}
