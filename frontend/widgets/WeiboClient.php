<?php

namespace frontend\widgets;

use yii\authclient\OAuth2;
use yii\web\HttpException;
use Yii;

class WeiboClient extends OAuth2
{
    public $authUrl = 'https://api.weibo.com/oauth2/authorize';

    public $tokenUrl = 'https://api.weibo.com/oauth2/access_token';

    public $apiBaseUrl = 'https://api.weibo.com/2';

    protected function initUserAttributes()
    {
        $user = $this->api('users/show.json', 'GET');

        return [
        	'client' => 'weibo',
        	'openid' => $user['id'],
        	'nickname' => $user['name'],
        	'gender' => $user['gender'],
        	'location' => $user['location'],
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
        $str = file_get_contents('https://api.weibo.com/2/account/get_uid.json?access_token='.$params['access_token']);
        $user = json_decode($str);
        $params['uid'] = $user->uid;
        return $this->sendRequest($method, $url, $params, $headers);
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
        return 'fa fa-weibo fa-2x';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return '微博登录';
    }
}
