<?php
	if(!defined('CAPTCHA_ENTRACE'))die('error');
	/**
	 * 验证码设置
	 * @author davey.xia
	 * @date 2014-12-24
	 */	
	class SHOW_CONTROLLER{
		
		public function show(){
			include('show.view.php');
		}
		//组合验证码参数
		public function coding(){
			$configArr = array();
			$fontfamily = $_GET['vFontFamily'];
			$fontcolortype = $_GET['vFontColorType'];
			$fontcolor = $_GET['vFontColor'];
			$fontsize = $_GET['vFontSize'];
			$bgcolor = $_GET['vBgColor'];
			$border = $_GET['vBorder'];
			$width = $_GET['vWidth'];
			$height = $_GET['vHeight'];
			$fontnumber = $_GET['vFontNumber'];
			$fonttype = $_GET['vFontType'];
			$fontdiff = $_GET['vFontDiff'];
			$sinline = $_GET['vSinLine'];
			$node = $_GET['vNode'];
			$line = $_GET['vLine'];
			$distortion = $_GET['vDistortion'];

			if(!empty($fontfamily)){
				$fontfamily = trim($fontfamily,'|');
				$configArr['fontfamily'] = explode('|',$fontfamily);
			}

			if($fontcolortype == 1 && !empty($fontcolor)){
				$fontcolor = trim($fontcolor,'|');
				$configArr['fontcolor'] = explode('|',$fontcolor);
			}

			if(!empty($fontsize)){
				$configArr['fontsize'] = $fontsize;
			}

			if(!empty($bgcolor)){
				$configArr['bgcolor'] = $bgcolor;
			}

			if(!empty($border)){
				$configArr['border'] = TRUE;
			}

			if(!empty($width)){
				$configArr['width'] = $width;
			}

			if(!empty($height)){
				$configArr['height'] = $height;
			}

			if(!empty($fontnumber)){
				$configArr['number'] = $fontnumber;
			}

			if(!empty($fonttype)){
				$configArr['lang'] = $fonttype;
			}

			if(!empty($fontdiff)){
				$configArr['fontdiff'] = $fontdiff;
			}

			if(!empty($sinline)){
				$configArr['sinline'] = TRUE;
			}

			if(!empty($node)){
				$configArr['noisepoint'] = $node;
			}

			if(!empty($line)){
				$configArr['noiseline'] = $line;
			}

			if(!empty($distortion)){
				$configArr['distortion'] = $distortion;
			}

			if(!empty($configArr)){
				echo base64_encode(json_encode($configArr));
			}else{
				echo '';
			}	
		}	
	}
?>