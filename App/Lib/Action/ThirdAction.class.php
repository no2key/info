<?php
/**
 * Created by PhpStorm.
 * User: mengjun
 * Date: 14-9-21
 * Time: 下午10:33
 */

class ThirdAction extends Action {
	public function qq() {
		$app_id = "101155787";
		$app_secret = "eb474bcb4a526cdf02ed0a9aa7a055e9";
		$my_url = "http://datougou.cn/info/index.php?m=third&a=qq";
		$code = $_GET['code'];
		if(empty($code)) {
			$_SESSION['state'] = md5(uniqid(rand(), TRUE));
			//拼接URL
			$dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
				. $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
				. $_SESSION['state'];
			echo("<script> top.location.href='" . $dialog_url . "'</script>");
		}
		if($_REQUEST['state'] == $_SESSION['state']) {
			//拼接URL
			$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
				. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
				. "&client_secret=" . $app_secret . "&code=" . $code;
			$response = file_get_contents($token_url);
			if (strpos($response, "callback") !== false) {
				$lpos = strpos($response, "(");
				$rpos = strrpos($response, ")");
				$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
				$msg = json_decode($response);
				if (isset($msg->error)) {
					echo "<h3>error:</h3>" . $msg->error;
					echo "<h3>msg  :</h3>" . $msg->error_description;
					exit;
				}
			}

			//Step3：使用Access Token来获取用户的OpenID
			$params = array();
			parse_str($response, $params);
			$graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token'];
			$str  = file_get_contents($graph_url);
			if (strpos($str, "callback") !== false) {
				$lpos = strpos($str, "(");
				$rpos = strrpos($str, ")");
				$str  = substr($str, $lpos + 1, $rpos - $lpos -1);
			}
			$user = json_decode($str);
			if (isset($user->error)) {
				echo "<h3>error:</h3>" . $user->error;
				echo "<h3>msg  :</h3>" . $user->error_description;
				exit;
			}
			$User = D('User');
			$data = array('password' => $user->openid);
			$list = $User->where($data)->select();
			if (isset($list[0])) {
				cookie('token', aes_encode($list[0]['username']), array('expire'=>time()+3600*24));
				$this->success(LT('denglu').LT('chenggong'), C('BASE_URI'), false, array('token'=>aes_encode($list[0]['username'])));
			} else {
				$User->password = $user->openid;
				$User->username = "qq_".uniqid();
				$User->add();

				cookie('token', aes_encode($User->username), array('expire'=>time()+3600*24));
				$this->success(LT('denglu').LT('chenggong'), C('BASE_URI'), false, array('token'=>aes_encode($User->username)));
			}
			echo("Hello " . $user->openid);
		} else {
			echo("The state does not match. You may be a victim of CSRF.");
		}
	}
}

