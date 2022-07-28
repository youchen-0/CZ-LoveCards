<?
//函数
$str = "/(黄)|(赌)|(毒)|(Q币)|(电影网站)|(聚合影视APP)|(视频聊天)|(直播)|(P2P)|(私彩)|(要饭网)|(各种盗号钓鱼软件)|(游戏外挂辅助)|(短信)|(电话轰炸机)|(以及话费充值)|(直播盒子)|(百度云盘)|(王者荣耀CDK)|(以及各种抽奖)|(一元夺宝)|(股票)|(金融)|(理财)|(彩票福利)|(洗钱)|(信用卡套现)|(花呗套现)/";//替换目标
$str1 = "*";//替换字符
function str($str,$str1,$content){
	return preg_replace($str,$str1,$content);
}

//函数参数赋值
$toemail = $_POST['toemail'];//接收者邮箱

$bbk_name1 = str($str,$str1,$card_row['name_1']);//表白卡发布者
$bbk_name2 = str($str,$str1,$card_row['name_2']);//被表白者
$bbk_content = str($str,$str1,$card_row['cont']);//表白内容
$bbk_pl = str($str,$str1,$card_row['comment']);//当前评论数
$bbk_zan = str($str,$str1,$card_row['zan']);//当前赞数
$bbk_comment = str($str,$str1,$comment_data);
$bbk_url = "http://".SYSTEM_URL."/index/card.php?id=".$card_row['id'];
$img = $card_row['img'];
$time = date("Y年m月d日h时i分s秒");	

//内容整理
require_once ($_SERVER['DOCUMENT_ROOT']."email/send.php");//引入发件函数
$title = "您收到一张表白卡“{$bbk_name1}表白{$bbk_name2}”";//邮件标题
$name = "FatDa派送员";//邮件发送方
$url = "http://fatda.cn";//邮件发送方链接
//邮件大图
if($img == 'false'){
	$img = "https://api.ixiaowai.cn/mcapi/mcapi.php";
}

$content = <<<html
	<div style="width: 550px;height: auto;border-radius: 5px;margin:0 auto;border:1px solid #ffb0b0;box-shadow: 0px 0px 20px #888888;position: relative;">
		<div style="background-image: url(http:{$img});width:550px;height: 250px;background-size: cover;background-repeat: no-repeat;border-radius: 5px 5px 0px 0px;"></div>
		<div style="background-color:white;line-height:180%;padding:0 15px 12px;width:520px;margin:10px auto;color:#555555;font-family:'Century Gothic','Trebuchet MS','Hiragino Sans GB',微软雅黑,'Microsoft Yahei',Tahoma,Helvetica,Arial,'SimSun',sans-serif;font-size:12px;margin-bottom: 0px;">
			<h2 style="border-bottom:1px solid #DDD;font-size:14px;font-weight:normal;padding:13px 0 10px 8px;"><span style="color: #12ADDB;font-weight: bold;">&gt; </span>邮件服务，由<a style="text-decoration:none;color: #12ADDB;" href="{$url}" target="_blank">{$name}</a>提供</h2>
			<div style="padding:0 12px 0 12px;margin-top:18px">
			<p>发送时间：<span style="border-bottom:1px dashed #ccc;" t="5" times=" 20:42">{$time}</span></p> 
				<p><strong>{$bbk_name1}</strong>表白<strong>{$bbk_name2}</strong>&nbsp;内容：</p>
				<p style="background-color: #f5f5f5;border: 0px solid #DDD;padding: 10px 15px;margin:18px 0">{$bbk_content}</p>
				<p>表白卡信息：</p>
				<p style="background-color: #f5f5f5;border: 0px solid #DDD;padding: 10px 15px;margin:18px 0">点赞：{$bbk_zan}<br />评论：{$bbk_pl}条<br />最新评论：“{$bbk_comment}”</p>
			</div>
		</div>
		<a style="text-decoration: none;color: rgb(255, 255, 255);width: 40%;text-align: center;background-color: rgb(255, 114, 114);height: 40px;line-height: 40px;box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.3);display: block;margin: auto;" href="{$bbk_url}" target="_blank">查看表白卡</a>
		<div style="color:#8c8c8c;;font-family: 'Century Gothic','Trebuchet MS','Hiragino Sans GB',微软雅黑,'Microsoft Yahei',Tahoma,Helvetica,Arial,'SimSun',sans-serif;font-size: 10px;width: 100%;text-align: center;">
			<p>©2021 Copyright {$name}</p>
		</div>
	</div>
html
;//邮件内容

//发送并判断结果

if(Funmail($toemail,$title,$content) == "1"){
	echo '<script>window.location.href="email.php?notifications=1&notifications_content=邮件发送成功！"</script>';
	exit;
}else{ 
	echo '<script>window.location.href="email.php?notifications=2&notifications_content=邮件发送失败！"</script>';
	exit;
}

?>