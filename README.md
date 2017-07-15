YiiCMS
===================================

[![Latest Stable Version](https://poser.pugx.org/yiichina/yii2-cms/v/stable.png)](https://packagist.org/packages/yiichina/yii2-cms)
[![Total Downloads](https://poser.pugx.org/yiichina/yii2-cms/downloads.png)](https://packagist.org/packages/yiichina/yii2-cms)
[![Build Status](https://img.shields.io/travis/yiichina/yii2-cms.svg)](http://travis-ci.org/yiichina/yii2-cms)
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)

YiiCMS (http://www.yiicms.com) 是 Yii Framework 中文社区 (http://www.yiichina.com) 发起的开源项目，遵循 BSD 开源协议。
致力于帮助刚入门的同学理解 Yii2 的使用。

YiiCMS群：7594839 (加群请注明：YiiCMS)


目录结构
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```


要求
------------

- 此项目需要您的WEB服务器最低为 PHP 5.4。
- 在 PHP 7 环境工作更好。

安装
------------

### 从归档文件安装

TBD


### 通过 Composer 安装

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

您也可以安装应用程序使用以下命令：

~~~
php composer.phar global require "fxp/composer-asset-plugin:^1.2.0"
php composer.phar create-project --prefer-dist --stability=dev yiichina/yii2-cms
~~~


开始
---------------

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend `/path/to/yii-application/frontend/web/` and using the URL `http://frontend/`
- for backend `/path/to/yii-application/backend/web/` and using the URL `http://backend/`

To login into the application, you need to first sign up, with any of your email address, username and password.
Then, you can login into the application with same email address and password at any time.
