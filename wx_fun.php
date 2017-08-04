<?php

/*-------------------------------------------微信API/-------------------------------------------*/

//ERROR日志
function errorLog($log){
	$filename = 'error.txt';
	$temp = file_get_contents($filename);
	file_put_contents($filename,$temp.date("Y-m-d H:i:s")."\nlog=".$log."\n\n");
}


//发送文本------内容
function sendText($contentStr){
	//内容不能为空
	if($contentStr==''){
		return false;
	}
	
	$textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				<FuncFlag>0</FuncFlag>
				</xml>";
		
	$userName 		= $GLOBALS["userName"];
	$developerName	= $GLOBALS["developerName"];
	$time 			= $GLOBALS["dtime"];
	$msgType 		= "text";
	
	//errorLog('999999999');

	$resultStr = sprintf($textTpl, $userName, $developerName, $time, $msgType, $contentStr);


	echo $resultStr;//发送

	return true;
}

//发送图文------Array标题/摘要/图片地址/地址
function sendNews($contentStr){

	$newsTpl1 = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<ArticleCount><![CDATA[%s]]></ArticleCount>
				 <Articles>";
	$newsTpl3 = "</Articles></xml>";
		
	$userName 		= $GLOBALS["userName"];
	$developerName 	= $GLOBALS["developerName"];
	$time 			= $GLOBALS["dtime"];
	$msgType 		= "news";								
	
	foreach ($contentStr as $value){
		$news_t .= "<item>
				 <Title><![CDATA[".$value['Title']."]]></Title> 
				 <Description><![CDATA[]]></Description>
				 <PicUrl><![CDATA[".$value['PicUrl']."]]></PicUrl>
				 <Url><![CDATA[".$value['Url']."]]></Url>
				 </item>";
		$news_n++;
	}

	$resultStr = sprintf($newsTpl1, $userName, $developerName, $time, $msgType, $news_n).$news_t.$newsTpl3;


	echo $resultStr;//发送

	return true;
}





?>