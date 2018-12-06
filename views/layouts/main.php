<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;
use app\widgets\Notify;
use app\widgets\SimpleModal;
use app\helpers\MiscHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?7532827431e9d717ecc9041e97edcdfe";
  var s = document.getElementsByTagName("script")[0]; 
</script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name . ' <font class="h6">' . Yii::$app->version . '</font>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top'
        ]
    ]);
    $menus = [
        [
            'label' => '首页',
            'url' => [
                '/site/index'
            ]
        ]
    ];
    if (! \Yii::$app->user->isGuest && MiscHelper::isAdmin()) {
        $menus = $menus + [

            [
                'label' => '项目',
                'url' => [
                    '/project/index'
                ]
            ],
            [
                'label' => '故事状态',
                'url' => [
                    '/story-status/index'
                ]
            ],
            [
                'label' => '事件',
                'items' => [
                    [
                        'label' => '事件维护',
                        'url' => [
                            '/event/index'
                        ]
                    ],
                    [
                        'label' => '事件处理器',
                        'url' => [
                            '/event-handler/index'
                        ]
                    ]
                ]
            ],
            [
                'label' => '机器人',
                'items' => [
                    [
                        'label' => '机器人维护',
                        'url' => [
                            '/im-robot/index'
                        ]
                    ],
                    [
                        'label' => '机器人消息模板',
                        'url' => [
                            '/robot-message/index'
                        ]
                    ]
                ]
            ],
            [
                'label' => '用户',
                'url' => [
                    '/user/index'
                ]
            ],
            [
                'label' => '系统',
                'items' => [
                    [
                        'label' => '路由',
                        'url' => [
                            '/ac-route/index'
                        ]
                    ],
                    [
                        'label' => '模块',
                        'url' => [
                            '/app-module/index'
                        ]
                    ],
                    [
                        'label' => '角色',
                        'url' => [
                            '/auth-role/index'
                        ]
                    ],
                    [
                        'label' => '权限',
                        'url' => [
                            '/auth-permission/index'
                        ]
                    ],
                    [
                        'label' => '规则',
                        'url' => [
                            '/auth-rule/index'
                        ]
                    ]
                ]
            ]
        ];
    }
    if (! \Yii::$app->user->isGuest) {
        $menus[] = [
            'label' => '控制台',
            'url' => [
                '/space'
            ]
        ];
    }
    $menus[] = [
        'label' => '关于' . Yii::$app->name,
        'url' => [
            '/site/about'
        ]
    ];
    if (! \Yii::$app->user->isGuest) {
        $menus[] = [
            'label' => Yii::$app->user->identity->nick_name,
            'items' => [
                [
                    'label' => '个人信息',
                    'url' => [
                        '/user/profile'
                    ],
                    'linkOptions' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
                    ]
                ],
                [
                    'label' => '退出',
                    'url' => [
                        '/site/logout'
                    ],
                    'linkOptions' => [
                        'data-method' => 'post'
                    ]
                ]
            ]
        ];
    } else {
        $menus[] = [
            'label' => '登录',
            'url' => [
                '/site/login'
            ]
        ];
    }
    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav navbar-right'
        ],
        'items' => $menus
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []])?>
        <?= Alert::widget() ?>
        <?= Notify::widget() ?>
        <?= $content ?>
        <?php

        SimpleModal::begin([
            //'size' => 'modal-lg',
            'header' => '对话框',
            'options' => [
                'id' => 'modal-dailog'
            ]
        ]);
        echo "没有记录";
        SimpleModal::end();
        ?>
    </div>
	</div>

	<footer class="footer">
		<div class="container">
			<p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
