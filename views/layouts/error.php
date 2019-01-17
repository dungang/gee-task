<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $_joined_projects array */
/* @var $_project_id int */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
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
<meta name="Keywords" content="极简敏捷项目管理" />
<meta name="Description" content="极简敏捷项目管理" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?7532827431e9d717ecc9041e97edcdfe";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $logoItem = [
        'brandLabel' => Yii::$app->name . ' <font class="h6">' . Yii::$app->version . '</font>',
        'brandUrl' => [
            '/space'
        ],
        'options' => [
            'class' => 'navbar-default navbar-fixed-top'
        ]
    ];

    NavBar::begin($logoItem);
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => [
            'class' => 'navbar-nav navbar-right'
        ],
        'items' => [
            [
                'label' => '控制台',
                'url' => [
                    '/space'
                ]
            ],
            [
                'label' => '<i class="glyphicon glyphicon-dashboard"></i> 管理后台',
                'url' => [
                    '/'
                ]
            ],
            [
                'label' => '<i class="glyphicon glyphicon-cog"></i> ' . Yii::$app->user->identity->nick_name,
                'items' => [
                    [
                        'label' => '<i class="glyphicon glyphicon-credit-card"></i> 个人信息',
                        'url' => [
                            '/user/profile'
                        ],
                        'linkOptions' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-dailog'
                        ]
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-globe"></i> 我创建的项目',
                        'url' => [
                            '/myproject/default/index'
                        ]
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-leaf"></i> 关于' . Yii::$app->name,
                        'url' => [
                            '/site/about'
                        ]
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-off"></i> 退出',
                        'url' => [
                            '/site/logout'
                        ],
                        'linkOptions' => [
                            'data-method' => 'post'
                        ]
                    ]
                ]
            ]
        ]
    ]);
    NavBar::end();
    ?>
		<div class="container">
        	<?= $content ?>
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
