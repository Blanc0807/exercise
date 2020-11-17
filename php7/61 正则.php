<?php
// 正则表达式定界符可以使用/ 也可以使用@
var_dump(preg_match('/a/', 'abc'));
var_dump(preg_match('@/@', '/asd'));

// \d 0-9  |  \D ^0-9
// \w a-zA-Z0-9 | \W ^a-zA-Z0-9
// \s 匹配任意空白 | \S
// \n \t

// 原子匹配 [abc]
preg_match('/[12]/', '123'); //return 1;
// 原子组 (12) 一组
preg_match('/\.(com)/', 'baidu.com, replace.com, google.com'); // 匹配com

// ^ 以...开头
// & 以...结尾

//选择修饰符 |
$str = 'baidu.com, google.com, sina.com';
$preg = '/(baidu|google|sina)\.com/';
$replace = '\1\2\3';
var_dump(preg_replace($preg, $replace, $str));

// 贪婪匹配
// + 1个或多个
// * 0个或多个
// ? 0个或1个
// {n} n个
// {n,} 至少n个
// {n, m} n到m个

// 禁止贪婪匹配
// +?       重复一个或多个，尽可能减少重复
// *?       重复任意次数，尽可能减少重复
// ??       重复0到1次，尽可能减少重复
// {n, m}   重复n到m次。尽可能减少重复
// {n,}?    重复n次以上，尽可能减少重复
/*
 * array(2) {
  [0]=>
  array(2) {
    [0]=>
    string(18) "<h1>第一段</h1>"
    [1]=>
    string(18) "<h1>第二段</h1>"
  }
  [1]=>
  array(2) {
    [0]=>
    string(9) "第一段"
    [1]=>
    string(9) "第二段"
  }
}*/
$str1 = '<h1>第一段</h1><h1>第二段</h1>';
$preg1 = '/<h1>(.+?)<\/h1>/';
preg_match_all($preg1, $str1, $result);
var_dump($result);

//修正符
// i 不区分大小写
// s 将字符串视为单行
$str2 = '<h1>第一段</h1>
<H2>第二段</H2>';
$preg2 = '/<h([1-6])>(.+?)<\/h\1>/is';
preg_match_all($preg2, $str2, $result1);
var_dump($result1);