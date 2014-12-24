<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>验证码设置</title>
<style>
	body{ margin:0; padding:0; font-size:14px; font-family:'微软雅黑'}
	.vcode_area{ width:860px; margin:0 auto;}
	.vcode_choose{ border:1px solid #999; padding:15px; width:830px; margin-top:30px}
	.vcode_choose td{ padding:5px}
	.vcode_choose input{ font-size:14px; text-align:center}
	.vcode_choose input[type=text]{ height:30px; width:80px; color:#06F; line-height:30px}
	.vcode_choose select{ height:30px}
	.vcode_choose input[type=button]{ width:100px; height:30px; color:#C30}
	.vcode_title{ height:35px; text-align:center; line-height:35px; background-color:#D7D7D7; color:#06F; margin-bottom:20px; font-weight:bold}
	.vcode_show{text-align:center; }
	.vcode_area span{ width:75px; display:block; text-align:center; float:left}
</style>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/color.js"></script>
</head>

<body>
	<div class="vcode_area">
    	<div class="vcode_choose">
    		<div class="vcode_title">验证码设置</div>
            <form method="post">
            	<table width="100%">
                	<tr>
                    	<td>背景颜色：</td>
                        <td><input name="vBgColor" type="text" class="color" id="vBgColor" value="DB3A4C" maxlength="6" /></td>
                        <td>显示边框：</td>
                        <td>
                        <select name="vBorder" id="vBorder">
                       	  <option value="0">否</option>
                        	<option value="1">是</option>
                      	</select>
               	  	  	</td>
                        <td>图片宽度：</td>
                        <td><input name="vWidth" type="text" id="vWidth" maxlength="4" /></td>
                        <td>图片高度：</td>
                        <td><input name="vHeight" type="text" id="vHeight" maxlength="4" /></td>
                      </tr>
                    	<tr>
                        <td>字符个数：</td>
                        <td><input name="vFontNumber" type="text" id="vFontNumber" value="4" maxlength="2" /></td>
                        <td>字体大小：</td>
                        <td><input name="vFontSize" type="text" id="vFontSize" value="" maxlength="2" /></td>
                        <td>字符类型：</td>
                        <td><select name="vFontType" id="vFontType">
                        	<option value="enum">英数</option>
                          <option value="cn">中文</option>
                          <option value="en">英文</option>
                          <option value="number">数字</option>
                        </select></td>
                        <td>字符间距：</td>
                        <td><input name="vFontDiff" type="text" id="vFontDiff" /></td>
                    </tr>
                    <tr>
                    	<td valign="top">
                        	选择字体：
                        </td>
                        <td colspan="7">
                        	<span><input name="vFontFamily" type="checkbox" value="AntykwaBold.ttf" id="vFontFamily" /></span>
                        	<span><input name="vFontFamily" type="checkbox" value="Candice.ttf" id="vFontFamily" /></span>
                            <span><input name="vFontFamily" type="checkbox" value="Ding-DongDaddyO.ttf" id="vFontFamily" /></span>
                            <span><input name="vFontFamily" type="checkbox" value="Duality.ttf" id="vFontFamily" /></span>
                            <span><input name="vFontFamily" type="checkbox" value="Heineken.ttf" id="vFontFamily" /></span>
                            <span><input name="vFontFamily" type="checkbox" value="Jura.ttf" id="vFontFamily" /></span>
                            <span><input name="vFontFamily" type="checkbox" value="StayPuft.ttf" id="vFontFamily" /></span>
                            <span><input name="vFontFamily" type="checkbox" value="TimesNewRomanBold.ttf" id="vFontFamily" /></span>
                            <span><input name="vFontFamily" type="checkbox" value="VeraSansBold.ttf" id="vFontFamily" /></span> 
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        </td>
                        <td colspan="7">
                            <img src="js/font.jpg" />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	字体颜色：
                        </td>
                      <td colspan="7">
                      	<input name="radio" type="radio" id="radio" value="0" checked="checked" onclick="$('#cfc').hide()" />
                        随机　
                        <input type="radio" name="radio" id="radio2" value="1" onclick="$('#cfc').show()" />
                      自选</td>
                  </tr>
                  <tr id="cfc" style="display:none">
<td>
                        </td>
                    <td colspan="7">
						<input name="vFontColor1" type="text" class="color" id="vFontColor1" value="FFFFFF" maxlength="6" />
						<input name="vFontColor2" type="text" class="color" id="vFontColor2" value="FFFFFF" maxlength="6" />
						<input name="vFontColor3" type="text" class="color" id="vFontColor3" value="FFFFFF" maxlength="6" />
						<input name="vFontColor4" type="text" class="color" id="vFontColor4" value="FFFFFF" maxlength="6" />
						<input name="vFontColor5" type="text" class="color" id="vFontColor5" value="FFFFFF" maxlength="6" />
                    <input name="vFontColor6" type="text" class="color" id="vFontColor6" value="FFFFFF" maxlength="6" /></td>
                  </tr>
                    <tr>
                    	<td>扭曲度数：</td>
                        <td><input name="vDistortion" type="text" id="vDistortion" value="3" maxlength="4" /></td>
                        <td>正弦干扰：</td>
                        <td>
                            <select name="vSinLine" id="vSinLine">
                            	<option value="1">是</option>
                              	<option value="0">否</option>
                            </select>
                        </td>
                        <td>干扰点量：</td>
                        <td><input name="vNode" type="text" id="vNode" value="0" maxlength="4" /></td>
                        <td>干扰线量：</td>
                        <td><input name="vLine" type="text" id="vLine" value="0" maxlength="4" /></td>
                    </tr>
                    <tr>
                    	<td colspan="8" align="center" style="background-color:#FDFFE6"><input name="" type="button" value="确认生成" onclick="GetConfig()" /></td>
                    </tr>
                </table>
        </form>
      	</div>
        <div class="vcode_choose">
            <div class="vcode_show" style="height:150px; overflow:hidden">
                <div class="vcode_title">验证码展示(点击图片更换验证码)</div>
                <img style="cursor:pointer" id="vcode" src="<?php echo CAPTCHA_URL?>index.php?a=captcha&m=getCaptcha" />	
            </div>
        </div>
        <div class="vcode_choose">    
            <div class="vcode_show">
                <div class="vcode_title">验证码代码</div>
                <textarea name="" cols="" rows="" style="width:700px; height:100px" id="codeWebCopy"><img src="<?php echo CAPTCHA_URL?>index.php?a=captcha&m=getCaptcha" /></textarea>
            </div>
        </div>    
    </div>
    <script>
		$(document).ready(function(){
			$('#vcode').click(function(){
				var src = $('#vcode').attr("src");
				$('#vcode').attr("src",src);	
			});	
		})
    	function GetConfig(){
			var vFontFamily = '';
			var vFontColorType = '';
			var vFontColor = '';
			var vBgColor = $.trim($('#vBgColor').val());
			var vFontSize = $.trim($('#vFontSize').val());
			var vBorder = $.trim($('#vBorder').val());
			var vWidth = $.trim($('#vWidth').val());
			var vHeight = $.trim($('#vHeight').val());
			var vFontNumber = $.trim($('#vFontNumber').val());
			var vFontColor = $.trim($('#vFontColor').val());
			var vFontType = $.trim($('#vFontType').val());
			var vFontDiff = $.trim($('#vFontDiff').val());
			var vDistortion = $.trim($('#vDistortion').val());
			var vSinLine = $.trim($('#vSinLine').val());
			var vNode = $.trim($('#vNode').val());
			var vLine = $.trim($('#vLine').val());
			$("input[type='checkbox']").each(function(){
				if($(this).is(':checked')){
					vFontFamily += $(this).val()+'|';
				}
			});
			$("input[type='radio']").each(function(){
				if($(this).is(':checked')){
					vFontColorType += $(this).val();
				}
			});
			if(vFontColorType == 1){
				var vFontColor1 = $.trim($('#vFontColor1').val());
				var vFontColor2 = $.trim($('#vFontColor2').val());
				var vFontColor3 = $.trim($('#vFontColor3').val());
				var vFontColor4 = $.trim($('#vFontColor4').val());
				var vFontColor5 = $.trim($('#vFontColor5').val());
				var vFontColor6 = $.trim($('#vFontColor6').val());
				
				if(vFontColor1 != ''){
					vFontColor += vFontColor1+'|'; 	
				}
				if(vFontColor2 != ''){
					vFontColor += vFontColor2+'|'; 	
				}
				if(vFontColor3 != ''){
					vFontColor += vFontColor3+'|'; 	
				}
				if(vFontColor4 != ''){
					vFontColor += vFontColor4+'|'; 	
				}
				if(vFontColor5 != ''){
					vFontColor += vFontColor5+'|'; 	
				}
				if(vFontColor6 != ''){
					vFontColor += vFontColor6+'|'; 	
				}
				
			}
			var data = 'vFontColorType='+vFontColorType+'&vFontFamily='+vFontFamily+'&vFontSize='+vFontSize+'&vBgColor='+vBgColor+'&vBorder='+vBorder+'&vWidth='+vWidth+'&vHeight='+vHeight+'&vFontNumber='+vFontNumber+'&vFontColor='+vFontColor+'&vFontType='+vFontType+'&vFontDiff='+vFontDiff+'&vDistortion='+vDistortion+'&vSinLine='+vSinLine+'&vNode='+vNode+'&vLine='+vLine;
			$.ajax({
				type: 'get',
				url: '<?php echo CAPTCHA_URL?>index.php?a=show&m=coding',
				data: data,
				success: function(backstr){
					$('#vcode').attr("src","<?php echo CAPTCHA_URL?>index.php?a=captcha&m=getCaptcha&config="+backstr+"&t="+new Date().getTime());
					$('#codeWebCopy').val('<img src="<?php echo CAPTCHA_URL?>index.php?a=captcha&m=getCaptcha&config='+backstr+'" />');
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					alert('error');
				}
			});	
		}
    </script> 
</body>
</html>