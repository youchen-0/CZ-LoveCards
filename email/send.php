<?php
    $one_mail_server = '';//SMTP服务器
    $one_mail_serverport = 25;//SMTP服务器端口
    $one_mail_user = '';//SMTP服务器的用户邮箱
    $one_mail_pass = '';//SMTP服务器的授权码
    $one_mail_username = 'FatDa邮递员';//发件人
        
    function Funmail($toemail,$title,$content){
    	global $one_mail_server;
    	global $one_mail_serverport;
    	global $one_mail_user;
    	global $one_mail_pass;
    	global $one_mail_username;
    	require_once ($_SERVER['DOCUMENT_ROOT']."email/smtp.class.php");
        //******************** 配置信息 ********************************
        $smtpserver = $one_mail_server;//SMTP服务器
        $smtpserverport = $one_mail_serverport;//SMTP服务器端口
        $smtpusermail = $one_mail_user;//SMTP服务器的用户邮箱
    
        $smtpuser = $one_mail_user;//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
        $smtppass = $one_mail_pass;//SMTP服务器的授权码
        $mailusername = $one_mail_username;//发件人
    	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
        //************************ 配置信息 ****************************
    	
    	$smtpemailto = $toemail;//发送给谁
    	$mailtitle = $title;//邮件主题
        $mailcontent = $content;//邮件内容
    	
        $smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype, $mailusername);
    	
    	if($state==false){
    		return "0";
    		exit();
        }
    	return "1";
    }
?>