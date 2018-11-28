<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $_joined_projects array */
/* @var $_project_id int */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
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
<meta name="Keywords" content="极简敏捷项目管理" />
<meta name="Description" content="极简敏捷项目管理" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $logoItem = [
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top'
        ]
    ];

    if (! Yii::$app->user->isGuest && $switchProjects = MiscHelper::switchProjectMenuItems()) {
        isset($switchProjects['label']) && $logoItem['brandLabel'] = $switchProjects['label'];
        isset($switchProjects['url']) && $logoItem['brandUrl'] = $switchProjects['url'];
    }

    NavBar::begin($logoItem);

    echo Nav::widget([
        'encodeLabels' => false,
        'options' => [
            'class' => 'navbar-nav navbar-right'
        ],
        'items' => [
            [
                'label' => '<i class="glyphicon glyphicon-retweet"></i> 切换控制台',
                'url' => [
                    '#control-panel'
                ],
                'linkOptions' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#switch-project-dialog'
                ]
            ],
            [
                'label' => '<i class="glyphicon glyphicon-user"></i> ' . Yii::$app->user->identity->username,
                'items' => [
                    [
                        'label' => '<i class="glyphicon glyphicon-credit-card"></i> 个人信息',
                        'url' => [
                            '/user/profile'
                        ]
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-globe"></i> 我创建的项目',
                        'url' => [
                            '/project/index'
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
    <div class="modal fade" id="switch-project-dialog" tabindex="-1" role="dialog"
			aria-labelledby="switchProjectDialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="switchProjectDialog">
							<i class="glyphicon glyphicon-globe"></i> 我加入的项目
						</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<?php if($switchProjects && $switchProjects['items']): ?>
                            <?php
        foreach ($switchProjects['items'] as $project) {
            $control = Html::a('<i class="glyphicon glyphicon-th-large"></i> 控制台', $project['url']);
            echo "<div class='col-md-6'><div class='thumbnail'>
                                        <div class='caption'>
                                            <p><h5>" . $project['label'] . "</h5></p>
                                            <p>${control}</p>
                                        </div>
                                    </div></div>";
        }
        ?>
                            <?php endif;?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
        <?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []])?>
        <?= Alert::widget() ?>
        <?= Notify::widget() ?>
        <?= $content ?>
        <?php

        SimpleModal::begin([
            'size' => 'modal-lg',
            'header' => '加载中 ... ',
            'options' => [
                'id' => 'modal-dailog'
            ]
        ]);
        echo "请耐心等待...";
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
