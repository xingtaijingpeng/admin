<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/28
 * Time: 7:20
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
define("APPID", "wx90105c6e46750e7c");
define("APPSECRET", "b1fbd6cf52750c95586101309a3993e8");

class WeixinController extends Controller
{
    public function getWeixinUser(Request $request){
		$code = $request->code;
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code=".$code."&grant_type=authorization_code";
		$cfg = array('ssl'=>'true', 'post'=>'false');
		$result = $this->curlOpen($url, $cfg);
		$res = json_decode($result, true);
		if(!empty($res['errcode'])){
			return $this->error('获取access_token以及openid失败');
		}

		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$res['access_token']."&openid=".$res['openid']."&lang=zh_CN";
		$result = $this->curlOpen($url, $cfg);
		$res = json_decode($result, true);
        if(!empty($res['errcode'])){
			return $this->error('获取用户微信信息失败');
		}
        return $this->success('success', $res);
    }

	public function generateWxConfig(Request $request){
		$tokenarr = $this->getAccessToken(APPID, APPSECRET);
		$jsapi_ticket = $this->getJsApiTicket($tokenarr['access_token']);
		$nonceStr = $this->getRandomChar();
		$time = time();
		$thisUrl = $request->link;
		$signature = sha1("jsapi_ticket=".$jsapi_ticket['ticket']."&noncestr=".$nonceStr."&timestamp=".$time."&url=".$thisUrl);
		$res = array(
			'appId' => APPID,
			'timestamp' => $time,
			'nonceStr' => $nonceStr,
			'signature' => $signature,
		);
		return $this->success('success', $res);
	}

	/**
	 * 获取ACCESS TOKEN
	 */
	public function getAccessToken($AppId, $AppSecret)
	{
		$cfg['ssl'] = true;
		$cfg['post'] = false;
		$last_access_token = Redis::get("weixin_access_token");
		$last_access_token = json_decode($last_access_token, true);
		$access_token_lasttime = $last_access_token['created_time'];
		if( empty($last_access_token) || (time() - $access_token_lasttime) > 5400 )
		{
			$result = $this->curlOpen("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$AppId&secret=$AppSecret", $cfg);
			$result = json_decode($result, true);
			$result['created_time'] = time();
			Redis::set("weixin_access_token", json_encode($result));
		}else{
			$result = $last_access_token;
		}
		return $result;
	}

	/**
	 * 获取jsapi_ticket
	 */
	public function getJsApiTicket($token)
	{
		$last = Redis::get("weixin_jsapi_ticket");
		$last = json_decode($last, true);
		$lasttime = $last['created_time'];
		if( empty($last) || (time() - $lasttime) > 5400 )
		{
			$result = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$token."&type=jsapi");
			$result = json_decode($result, true);
			$result['created_time'] = time();
			Redis::set("weixin_jsapi_ticket", json_encode($result));
		}else{
			$result = $last;
		}
		return $result;
	}

	public function getRandomChar($length = 8){
		$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
		'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',
		't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',
		'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O',
		'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',
		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
		$password = '';
		for($i = 0; $i < $length; $i++)
		{
			// 将 $length 个数组元素连接成字符串
			$password .= $chars[rand(0,count($chars)-1)];
		}
		return $password;
	}

	public function curlOpen ($url, $cfg)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if ($cfg['ssl']) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $cfg['post']);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        //print_r($info);exit;
        curl_close($ch);

        return $result;
    }
}
