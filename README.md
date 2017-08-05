YiiCMS
===================================

[![Latest Stable Version](https://poser.pugx.org/yiichina/yii2-cms/v/stable.png)](https://packagist.org/packages/yiichina/yii2-cms)
[![Total Downloads](https://poser.pugx.org/yiichina/yii2-cms/downloads.png)](https://packagist.org/packages/yiichina/yii2-cms)
[![License](https://poser.pugx.org/yiichina/yii2-cms/license)](https://packagist.org/packages/yiichina/yii2-cms)
[![Build Status](https://img.shields.io/travis/yiichina/yii2-cms.svg)](http://travis-ci.org/yiichina/yii2-cms)
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)

YiiCMS (http://www.yiicms.com) 是 Yii Framework 中文社区 (http://www.yiichina.com) 发起的开源项目，遵循 BSD 开源协议。
致力于帮助刚入门的同学理解 Yii2 的使用。

YiiCMS群：7594839 (加群请注明：YiiCMS)


目录结构
--------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
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
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

安装方式
--------
创建数据库，推荐 MySQL，默认库名为yii2_cms，编码选utf8_unicode_ci。

```
composer create-project --prefer-dist yiichina/yii2-cms <project-name> 

cd <project-name>
./init
```
修改数据库配置，位于 `@common/config/main-local.php`
```
./yii migrate
```
功能简介
-------

1. adminLTE
2. 国际化
3. RBAC
4. 第三方登录
5. 评论模块
6. 后台更换主题
7. 分享
8. 赞功能
9. 收藏
