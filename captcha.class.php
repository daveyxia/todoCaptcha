<?php 
	/**
	 * 验证码生成类
	 * @author davey.xia
	 * @date 2014-12-24
	 */
	if(!defined('CAPTCHA_ENTRACE'))die('error');
	class CAPTCHA_MODEL{
		//定义验证码图片高度 
		private $height;
		//定义验证码图片宽度 
		private $width;
		//定义验证码字符个数
		private $textNum; 
		//定义验证码字符内容 
		private $textContent; 
		//定义字符颜色
		private $fontColor;
		//字符宽度
		private $fontWidth;
		//字符高度
		private $fontHeight;
		//定义随机出的文字颜色 
		private $randFontColor; 
		//定义字体大小
		private $fontSize; 
		//定义字符间距
		private $fontDiff;
		//定义字体 
		private $fontFamily; 
		//定义背景颜色 
		private $bgColor; 
		//定义随机出的背景颜色 
		private $randBgColor; 
		//定义字符语言 
		private $textLang; 
		//定义干扰点数量
		private $noisePoint; 
		//定义干扰线数量 
		private $noiseLine;
		//是否显示干扰线
		private $sinLine;
		//定义是否扭曲
		private $distortion;
		//定义扭曲图片源 
		private $distortionImage;
		//定义是否有边框
		private $showBorder;
		//定义验证码图片源 
		private $image;

		//设置参数
		public function __set($name,$value){
			$this->$name = $value;
		}
		//设置参数
		public function __get($name){
			return $this->$name;
		}
		//
		function __destruct() {
			if(!is_null($this->image)){
				imagedestroy($this->image);
			}
		}
		//初始化验证码图片 
		private function initImage(){ 
			if(empty($this->width)){
				$this->width = floor($this->fontSize*1.3)*$this->textNum+10;
			} 
			if(empty($this->height)){
				$this->height = $this->fontSize*2;
			}
			$this->image = imagecreatetruecolor($this->width,$this->height);
			if(empty($this->bgColor)){
				$this->randBgColor = imagecolorallocate($this->image,mt_rand(100,255),mt_rand(100,255),mt_rand(100,255)); 
			}else{
				$color = $this->getColorRGB($this->bgColor);
				$this->randBgColor = imagecolorallocate($this->image,$color[0],$color[1],$color[2]);
			} 
			imagefill($this->image,0,0,$this->randBgColor); 
		} 
		//产生随机字符 
		private function randText(){
			$string = ''; 
			switch($this->textLang){
				case 'enum':
					$str = 'ABCDEFGHJKLMNPQRSTUVWXY3456789'; 
					for($i=0;$i<$this->textNum;$i++){ 
						$string = $string.','.$str[mt_rand(0,29)]; 
					} 
					break;
				case 'en':
					$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
					for($i=0;$i<$this->textNum;$i++){
						$string = $string.','.$str[mt_rand(0,25)];
					}
					break;
				case 'number':
					$str = '0123456789';
					for($i=0;$i<$this->textNum;$i++){
						$string = $string.','.$str[mt_rand(0,9)];
					}
					break;
				case 'cn': 
					for($i=0;$i<$this->textNum;$i++) { 
						$string = $string.','.chr(rand(0xB0,0xCC)).chr(rand(0xA1,0xBB)); 
					}
					//转换编码到utf8
					$string = iconv('GB2312','UTF-8',$string);
				break;
			} 
			return substr($string,1); 
		} 
		//输出文字到验证码 
		private function createText(){
			$textArray = explode(',',$this->randText());
			$this->textContent = join('',$textArray);
			$lines = $this->getTextBlock($textArray);
			for($i=0;$i<$this->textNum;$i++){
				if(empty($this->fontColor)){
					$this->randFontColor = imagecolorallocate($this->image,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
				}else{
					$color = $this->fontColor[mt_rand(0,(count($this->fontColor)-1))];
					$color = $this->getColorRGB($color);
					$this->randFontColor = imagecolorallocate($this->image,$color[0],$color[1],$color[2]);
				}
				$angle = mt_rand(-1,1)*mt_rand(1,20);
				$x = $lines[$i][0];
				$y = $lines[$i][1];
				imagettftext($this->image,$this->fontSize,$angle,$x,$y,$this->randFontColor,$this->fontFamily,$textArray[$i]);
			} 
		} 
		//获取字符的角度，用来控制字符的间距
		private function getTextBlock($textArr){
			$diffArr[0] = array(10,floor($this->height*0.75));
			for($i=0;$i<count($textArr)-1;$i++){
				$diffSize = imagettfbbox($this->fontSize, 0, $this->fontFamily, $textArr[$i]);
				$diffArr[$i+1] = array(($diffSize[4]+$this->fontDiff+$diffArr[$i][0]),$diffArr[0][1]);
			}
			return $diffArr;
		}
		//生成干扰点 
		private function createNoisePoint(){ 
			for($i=0;$i<$this->noisePoint;$i++){ 
				$pointColor = imagecolorallocate($this->image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)); 
				imagesetpixel($this->image,mt_rand(0,$this->width),mt_rand(0,$this->height),$pointColor); 
			}
		} 
		//产生干扰线
		private function createNoiseLine(){ 
			for($i=0;$i<$this->noiseLine;$i++) {
				imageline($this->image,0,mt_rand(0,$this->width),$this->width,mt_rand(0,$this->height),$this->randFontColor);
			}
		} 
		//产生正弦干扰线
		private function createSinLine(){
			$h1 = rand(-5,5);
			$h2 = rand(-1,1);
			$w2 = rand(10,15);
			$h3 = rand(4,6);
			for($i=-$this->width/2;$i<$this->width/2;$i=$i+0.1){
				$y = $this->height/$h3*sin($i/$w2)+$this->height/2+$h1;
				imagesetpixel($this->image,$i+$this->width/2,$y,$this->randFontColor);
				$h2 != 0 ? imagesetpixel($this->image,$i+$this->width/2,$y+$h2,$this->randFontColor) : null;
			}
		}
		//扭曲文字
		private function distortionText(){ 
			$this->distortionImage = imagecreatetruecolor($this->width,$this->height); 
			imagefill($this->distortionImage,0,0,$this->randBgColor); 
			for($x=0;$x<$this->width;$x++){ 
				for($y=0;$y<$this->height;$y++){ 
					$rgbColor = imagecolorat($this->image,$x,$y); 
					imagesetpixel($this->distortionImage,(int)($x+sin($y/$this->height*2*M_PI-M_PI*0.5)*$this->distortion),$y,$rgbColor);
				} 
			} 
			$this->image = $this->distortionImage; 
		}
		//获取颜色编码的RGB
		private function getColorRGB($color){
			return array(hexdec($color[0].$color[1]),hexdec($color[2].$color[3]),hexdec($color[4].$color[5]));
		}
		
		//生成验证码图片
		public function createImage(){
			//创建基本图片
			$this->initImage();
			//输出验证码字符
			$this->createText();
			//扭曲文字  
			if(!empty($this->distortion)){
				$this->distortionText();
			}
			//产生干扰点
			if(!empty($this->noisePoint)){
				$this->createNoisePoint();
			}
			//产生干扰线
			if(!empty($this->noiseLine)){
				$this->createNoiseLine();
			}
			//产生正弦干扰线
			if($this->sinLine){
				$this->createSinLine();
			}
			//添加边框  
			if($this->showBorder){
				imagerectangle($this->image,0,0,$this->width-1,$this->height-1,$this->randFontColor);
			}
			imagepng($this->image); 
			imagedestroy($this->image); 
			if($this->distortion){
				imagedestroy($this->distortionImage);
			} 
			return $this->textContent; 
		}
	} 
