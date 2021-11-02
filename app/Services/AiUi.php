<?php
namespace App\Services;

use GuzzleHttp\Client; 
use GuzzleHttp\Psr7;
 
/**
 * aiui讯飞开放平台  WebAPI
 * https://aiui.xfyun.cn/app
 * 
 */
class AiUi{

	/**
	 * aiui讯飞 文本处理接口
	 */
	function testWebaiui($text){
	 
		$URL = "http://openapi.xfyun.cn/v2/aiui";  
		$APPID = "5f991d3e";
		$API_KEY = "8daa9c2f2c21f1d7e4e56eb731962235";		
		$AUTH_ID = "ac6a8a568002d9bb87c5afb5d6a549cb"; 
		$DATA_TYPE = "text";
		$SCENE = "main";
		$RESULT_LEVEL = "complete";
		
		$LAT = "39.938838";
		$LNG = "116.368624";
		$AUE = "raw";
		$SAMPLE_RATE = "16000";
		// 个性化参数，需转义
		$PERS_PARAM = "{\\\"auth_id\\\":\\\"ac6a8a568002d9bb87c5afb5d6a549cb\\\",\\\"data_type\\\":\\\"text\\\",\\\"scene\\\":\\\"main\\\"}";	
 
		$FILE_PATH = public_path().'\\/test.txt';
		
		$Param= array( 
			"scene"=>$SCENE,
			"auth_id"=>$AUTH_ID,
			"data_type"=>$DATA_TYPE,
			"result_level"=>$RESULT_LEVEL,
			//如需使用个性化参数：
			"pers_param"=>$PERS_PARAM
		);

		$curTime = time();
		$paramBase64 = base64_encode(json_encode($Param));
		$checkSum = md5($API_KEY.$curTime.$paramBase64);
		
		$headers = array();
		$headers['X-CurTime'] = $curTime;
		$headers['X-Param'] =  $paramBase64;		
		$headers['X-CheckSum'] =  $checkSum;
		$headers['X-Appid'] =  $APPID;
   
		$client = new Client();

		$wen = \GuzzleHttp\Psr7\stream_for($text);

        $r = $client->request('POST', $URL, [
			'headers' => $headers,  
			'body' => $wen
		 ]);
		 
		$body = $r->getBody()->getContents();
		
		$body= urldecode($body);
		
		$body= json_decode($body);
	 
		if($body->code==="0"){ 
			$data['data'] = $body->data[0]->intent->answer->text; 
			$data['msg'] = $body->desc;
			return $data;
		}else{
			$data['code'] = $body->code;
			$data['msg'] = $body->desc;
			return $data;
		}  

	}
  
}
 