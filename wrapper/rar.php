<?php

/**
 * Class MyRecDirIt
 */
class MyRecDirIt extends RecursiveDirectoryIterator {
    function current() {
      //  return urldecode($this->getSubPathName()) .
        return $this->getFilename() .
            (is_dir(parent::current())?" [DIR]":"");
    }
}

$f = "rar://" . rawurlencode(dirname(__FILE__)) .
    DIRECTORY_SEPARATOR . 'rar.rar#';

$it = new RecursiveTreeIterator(new MyRecDirIt($f));

foreach ($it as $s) {
    echo $s, "\n";
}

var_dump(urldecode('a+b'));

//$p = rawurlencode('rar:///vagrant/wrapper/ra@r');
//var_dump(urlencode('file:///vagrant/wrapper/ra@r'));
//var_dump($p);
//$obj = new RecursiveDirectoryIterator('file:///vagrant/wrapper/ra@r');
$p = 'rar://'.rawurlencode(dirname(__FILE__)).'/ra%40r.rar#';
//$p = 'rar://'.dirname(__FILE__).'/ra@r.rar#';
//$p = 'rar';
var_dump($p);
$obj = new RecursiveDirectoryIterator($p);
var_dump($obj);

$it = new RecursiveTreeIterator($obj);

foreach ($it as $s){
    echo urldecode($s).PHP_EOL;
}

var_dump(rawurlencode('a b@c'));

echo file_get_contents('rar:///vagrant/wrapper/ra@r.rar*#/rar/license.txt');

echo file_get_contents($c = 'http://'.urldecode('one.test/index.html'));
var_dump($c);

$dir = opendir('rar:///vagrant/wrapper/ra@r.rar*#/rar'); //带*后，输出的文件名是urlencode处理过个
echo PHP_EOL;
echo '-------------';
echo PHP_EOL;



function readdira($dir)
{
    static $le=0;//叠加存储水平位置
    static $ld=0;
    $d=$le;  //保留进入目录前的水平位置

    

    $fd = opendir($dir);
    while (($f = readdir($fd)) !== false) {
       if($f === '..' || $f ==='.')// 排除.. 和. 目录
        continue;
           $item = $dir . DIRECTORY_SEPARATOR . $f;
//           echo str_pad('', $d ?? 0);//输出目录长度的空白
           //$l = strlen(basename($dir)) ;
           echo ($d==0)?'':str_pad('', $d-$ld,' ');//输出目录长度的空白
        echo ($d==0)?'':str_pad('|', $ld,'-');//输出目录长度的空白




        echo $f . PHP_EOL;




           if (is_dir($item)) {
               $ld = strlen(basename($item));
               $le = strlen($f) + $le;//累加目录长度
               readdira($item);
               $le =$d;
               //出目录[a]后，累计目录长度要去掉，如果这个目录里有子目录的情况，这些子目录的长度，不然出来后[a]的同级目录的子目录会利用以前的长度而不是
               //[a]时目录长度叠加的长度。
           }
/*                   echo str_pad('', $d ?? 0);//输出目录长度的空白
                   echo $f . PHP_EOL;*/
       }
}
$dir ='rar:///vagrant/wrapper/ra@r.rar*#/rar';
$dir='/vagrant/wrapper/rar';
readdira($dir);

