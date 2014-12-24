<?php
	error_reporting(0);
	//脚本执行时间设置
	set_time_limit(60);
	header('Content-Type:text/html;charset=utf-8');
	date_default_timezone_set('Asia/Shanghai');
	//设置入口
	define('CAPTCHA_ENTRACE',true);
	
	$dir_info = pathinfo($_SERVER['REQUEST_URI']);
	$dir_name = trim(str_replace("\\","/",$dir_info['dirname']),"/").'/';
	
	if($dir_name == '/')
		define('CAPTCHA_URL','http://'.$_SERVER['HTTP_HOST'].'/');
	else
		define('CAPTCHA_URL','http://'.$_SERVER['HTTP_HOST'].'/'.trim(str_replace("\\","/",$dir_info['dirname']),"/").'/');	
	
	if(empty($_GET['a']))
		$_GET['a'] = 'show';
		
	if(empty($_GET['m']))
		$_GET['m'] = 'show';
		
	if(file_exists($_GET['a'].'.controller.php')){
		include($_GET['a'].'.controller.php');
		$class = strtoupper($_GET['a']).'_CONTROLLER';
		$a = new $class();
		if(method_exists($a,$_GET['m'])){
			$a->$_GET['m']();
		}else{
			die('method not exists');	
		}
	}else{
		die('file not exists');	
	}
	
?>