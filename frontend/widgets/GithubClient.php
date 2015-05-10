<?php

namespace frontend\widgets;

use yii\authclient\clients\GitHub;

class GithubClient extends GitHub
{
    protected function initUserAttributes()
    {
        $user = $this->api('user', 'GET');

        return [
            'client' => 'github',
            'openid' => $user['id'],
            'nickname' => $user['name'],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'fa fa-github fa-2x';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'GitHub 登录';
    }
}
