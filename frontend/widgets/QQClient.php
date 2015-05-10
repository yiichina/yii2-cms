<?php

namespace frontend\widgets;

use yii\authclient\OAuth2;
use yii\web\HttpException;
use Yii;

class QQClient extends OAuth2
{
    public $authUrl = 'https://graph.qq.com/oauth2.0/authorize';

    public $tokenUrl = 'https://graph.qq.com/oauth2.0/token';

    public $apiBaseUrl = 'https://graph.qq.com';

    public $openid;

    protected function initUserAttributes()
    {
        $user = $this->api('user/get_user_info', 'GET');

        return [
        	'client' => 'qq',
        	'openid' => $this->openid,
        	'nickname' => $user['nickname'],
        	'gender' => $user['gender'],
        	'location' => $user['province'] . $user['city'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function buildAuthUrl(array $params = [])
    {
        $authState = $this->generateAuthState();
        $this->setState('authState', $authState);
        $params['state'] = $authState;

        return parent::buildAuthUrl($params);
    }

    /**
     * @inheritdoc
     */
    public function fetchAccessToken($authCode, array $params = [])
    {
        $authState = $this->getState('authState');
        if (!isset($_REQUEST['state']) || empty($authState) || strcmp($_REQUEST['state'], $authState) !== 0) {
            throw new HttpException(400, 'Invalid auth state parameter.');
        } else {
            $this->removeState('authState');
        }

        return parent::fetchAccessToken($authCode, $params);
    }

    /**
     * @inheritdoc
     */
    protected function apiInternal($accessToken, $url, $method, array $params, array $headers)
    {
        $params['access_token'] = $accessToken->getToken();
		$user = $this->getOpenid($params['access_token']);
		$params['oauth_consumer_key'] = $user->client_id;
        $params['openid'] = $user->openid;
        $this->openid = $user->openid;
        return $this->sendRequest($method, $url, $params, $headers);
    }

    /**
     * @inheritdoc
     */
    protected function getOpenid($access_token)
    {
    	$str = file_get_contents('https://graph.qq.com/oauth2.0/me?access_token='.$access_token);

        if (strpos($str, "callback") !== false)
		{
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str = substr($str, $lpos + 1, $rpos - $lpos -1);
		}

		return json_decode($str);
    }

    /**
     * @inheritdoc
     */
    protected function defaultReturnUrl()
    {
        $params = $_GET;
        unset($params['code']);
        unset($params['state']);
        $params[0] = Yii::$app->controller->getRoute();

        return Yii::$app->getUrlManager()->createAbsoluteUrl($params);
    }

    /**
     * Generates the auth state value.
     * @return string auth state value.
     */
    protected function generateAuthState()
    {
        return sha1(uniqid(get_class($this), true));
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'fa fa-qq fa-2x';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'QQ 登录';
    }
}
