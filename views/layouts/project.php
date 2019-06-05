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

        $switchProjects = MiscHelper::switchProjectMenuItems();
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
                    'label' => '<i class="glyphicon glyphicon-flag"></i> 故事地图',
                    'url' => [
                        '/space/default/index'
                    ]
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-tasks"></i> 迭代',
                    'url' => [
                        '/sprint/default/index'
                    ]
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-check"></i> 会议',
                    'url' => [
                        '/meet/default/index'
                    ]
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-paperclip"></i> 变更',
                    'url' => [
                        '/change/default/index'
                    ]
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-list"></i> 产品Backlog',
                    'url' => [
                        '/backlog/default/index'
                    ]
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-user"></i> 成员',
                    'url' => [
                        '/member/default/index'
                    ]
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-cutlery"></i> 工具',
                    'items' => [
                        [
                            'label' => '<i class="glyphicon glyphicon-warning-sign"></i> 阿里云日志',
                            'url' => [
                                '/aliyun-log/default/index'
                            ]
                        ],
                        [
                            'label' => '<i class="glyphicon glyphicon-comment"></i> 机器人',
                            'url' => [
                                '/robot/default/index'
                            ]
                        ],
                        [
                            'label' => '<i class="glyphicon glyphicon-link"></i> 常用链接',
                            'url' => [
                                '/link/default/index'
                            ]
                        ]
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
                            'label' => '<i class="glyphicon glyphicon-dashboard"></i> 管理后台',
                            'url' => [
                                '/'
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
        <div class="modal fade" id="switch-project-dialog" tabindex="-1" role="dialog" aria-labelledby="switchProjectDialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="switchProjectDialog">
                            <i class="glyphicon glyphicon-globe"></i> 我加入的项目
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php if ($switchProjects && $switchProjects['items']) : ?>
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?= Notify::widget() ?>

            <div class="jumbotron">
                <?php $project = MiscHelper::getProject(); ?>
                <h1><?= Html::encode($project['name']) ?> </h1>
                <p class="lead"><?= $this->title ?></p>
                <p class="text-muted">个体和互动高于流程和工具 , 可工作软件高于详尽的文档</p>
                <p class="text-muted">客户合作高于合同谈判 , 响应变化高于遵循计划</p>
            </div>

            <?= $content ?>
            <?php

            SimpleModal::begin([
                //'size' => 'modal-lg',
                'header' => '加载中 ... ',
                'options' => [
                    'id' => 'modal-dailog',
                    'data-backdrop' => 'static'
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