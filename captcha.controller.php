<?php
	/**
	 * 验证码模型
	 * @author davey.xia
	 * @date 2014-12-24
	 */
	if(!defined('CAPTCHA_ENTRACE'))die('error');
	class CAPTCHA_CONTROLLER{
		
		function __construct(){
			session_start();
		}
		/*
		* 获取验证码
		* @param	config				不设置将自动载入初始设置，config格式为base64_encode(json_encode(config))
		* 			
		* 以下config相关参数说明
		* @param	height				验证码图片高度
		* @param	width				验证码图片宽度
		* @param	number				需要设置的验证码字符数,大于2小于10
		* @param	fontcolor			字体颜色
		* @param	fontsize			字体大小 单位px，只须传入数字，不得小于8大于80
		* @param	fontdiff			字符距离 单位px,不得小于-20,不得大于20
		* @param	bgcolor				背景颜色
		* @param	lang				字符编码，cn中文 en英文
		* @param	noisepoint			杂点数量 不得小于0大于500
		* @param	noiseline			杂线数量 不得小于0大于50
		* @param	distortion			扭曲度值 不得小于-30大于30
		* @param	border				是否设置边框  bool值
		* @param	sinline				是否使用曲线  bool值
		* 
		* 请求验证码的格式	?config=
		*/
		public function getCaptcha(){
			
			require_once('captcha.class.php');
			$captcha = new CAPTCHA_MODEL();
			
			header("Content-type:image/png");
			
			//字体间距配置,如未传入自定义距离，将使用这个配置
			$fonts = array(
				'AntykwaBold.ttf'  => array('diff' => -3),
				'Candice.ttf'  => array('diff' =>-1.5),
				'Ding-DongDaddyO.ttf' => array('diff' => -2),
				'Duality.ttf'  => array('diff' => -2),
				'Heineken.ttf' => array('diff' => -2),
				'Jura.ttf'     => array('diff' => -2),
				'StayPuft.ttf' => array('diff' =>-1.5),
				'TimesNewRomanBold.ttf' => array('diff' => -2),
				'VeraSansBold.ttf' => array('diff' => -1),
			);
			
			//随机参数设置
			$fontSize = array(18,19,20);
			$textLang = array('en','cn','number','enum');
			$fontFamily = array('en'=>array('VeraSansBold.ttf'),
								'number'=>array('VeraSansBold.ttf'),
								'enum'=>array('VeraSansBold.ttf'),
								'cn'=>array('simhei.ttf'));
			$distortion = array(-5,-4,-3,3,4,5);
			$fontDiff = FALSE;

			
			//分配参数
			$captcha->textNum = 4;
			$captcha->fontSize = $fontSize[mt_rand(0,(count($fontSize)-1))];
			$captcha->textLang = 'en';
			
			$captcha->fontFamily = $fontFamily[$captcha->textLang][mt_rand(0,(count($fontFamily[$captcha->textLang])-1))];
			$captcha->noisePoint =  $noisePoint[mt_rand(0,(count($noisePoint)-1))];
			$captcha->distortion = $distortion[mt_rand(0,(count($distortion)-1))];
			$captcha->showBorder = FALSE;
			
			//分配用户自定义参数
			$config = $_GET['config'];
			if(!empty($config)){
				if($config = base64_decode($config)){
					$config = json_decode($config,TRUE);
					if(is_array($config)){
						if(!empty($config['height']) && is_numeric($config['height']))
							$captcha->height = $config['height'];
						
						if(!empty($config['width']) && is_numeric($config['width']))
							$captcha->width = $config['width'];
						
						if(!empty($config['number']) && is_numeric($config['number']) && $config['number'] >= 2 && $config['number'] <=10)
							$captcha->textNum = $config['number'];
						
						if(!empty($config['fontcolor']) && is_array($config['fontcolor']))
							$captcha->fontColor = $config['fontcolor'];
						
						if(!empty($config['fontsize']) && is_numeric($config['fontsize']) && $config['fontsize'] >= 8 && $config['fontsize'] <=80)
							$captcha->fontSize = $config['fontsize'];
						
						if(!empty($config['fontdiff']) && is_numeric($config['fontdiff']) && $config['fontdiff'] >= -20 && $config['fontdiff'] <=20)
							$fontDiff = TRUE;
							$captcha->fontDiff = $config['fontdiff'];
						
						if(!empty($config['bgcolor']))
							$captcha->bgColor = $config['bgcolor'];
						
						if(!empty($config['lang']) && in_array($config['lang'],$textLang))
							$captcha->textLang = $config['lang'];
						
						if(!empty($config['fontfamily']) && is_array($config['fontfamily']))
							$captcha->fontFamily = $config['fontfamily'][mt_rand(0,(count($config['fontfamily'])-1))];
						
						if(!empty($config['noisepoint']) && is_numeric($config['noisepoint']) && $config['noisepoint'] >= 0 && $config['noisepoint'] <=500)
							$captcha->noisePoint = $config['noisepoint'];
						
						if(!empty($config['noiseline']) && is_numeric($config['noiseline']) && $config['noiseline'] >= 0 && $config['noiseline'] <=50)
							$captcha->noiseLine = $config['noiseline'];
						
						if(!empty($config['distortion']) && is_numeric($config['distortion']) && $config['distortion'] >= -30 && $config['distortion'] <=30)
							$captcha->distortion = $config['distortion'];
						
						if(is_bool($config['border']))
							$captcha->showBorder = $config['border'];
						
						if(is_bool($config['sinline']))
							$captcha->sinLine = $config['sinline'];
						
					}else
						die('param error json');	
					
				}else
					die('param error base64');	
				
			}
			
			//如果使用中文验证码，只能使用黑体
			if($captcha->textLang == 'cn')
				$captcha->fontFamily = 'simhei.ttf';
			
			//如果未设置字体间距，将使用默认的
			if(!$fontDiff && array_key_exists($captcha->fontFamily,$fonts))
				$captcha->fontDiff = $fonts[$captcha->fontFamily]['diff'];

			//配置字体文件所在位置
			$ttfFolder = dirname($_SERVER['SCRIPT_FILENAME']);
			$ttfFolder .= '/fonts/';
			$captcha->fontFamily = $ttfFolder.$captcha->fontFamily;

			//输出验证码 
			$code = $captcha->createImage();
			
			$this->setCaptcha($code);
		}
		
		/*
		* 验证验证码
		* @param	time	客户端的时间
		* @param	key		分配的key
		* @param	token	token验证码	
							token生成规则	substr(md5(base64_encode($ip).base64_encode(time)),8,16).substr(md5(base64_encode($key.$pass)),8,16)
		* @param	code	用户输入的验证码	验证码md5(base64(code))加密
		* 验证验证码的格式	?code=
		*/
		public function checkCaptcha(){
			//判断code是否传入正确
			if(empty($_GET['code']))
				die('param error code');
				
			if(empty($_SESSION['Captcha']))
				die('param error session');	
			
			//验证code是否正确，不区分大小写,正确返回true 错误返回false
			if(strcasecmp($_GET('code'),$_SESSION['Captcha']))
				echo 'false';
			else
				echo 'true';
		}
		/*
		 * 记录本次生成的code，用于验证
		 */
		private function setCaptcha(&$code){
			$_SESSION['Captcha'] = $code;
		}
	}