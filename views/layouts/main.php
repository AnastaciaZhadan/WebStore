<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;
use app\components\CartWidget;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menu = [];
            $admin_widget = [
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Products',
                        'items' => [
                            ['label' => 'Product list', 'url' => ['/admin/product/index'],],
                            ['label' => 'Price History', 'url' => ['/admin/price-history/index']],
                        ],
                    ],
                    ['label' => 'Product Settings',
                        'items' => [
                            ['label' => 'Characteristics', 'url' => ['/admin/characteristic/index']],        
                            ['label' => 'Categories', 'url' => ['/admin/category/index']],
                        ],
                    ],
                    ['label' => 'Shop Settings',
                        'items' => [
                            ['label' => 'Payment methods', 'url' => ['/admin/payment/index']],
                            ['label' => 'Shipping methdos', 'url' => ['/admin/shipping/index']],
                        ],
                    ],
                    ['label' => 'Comment', 'url' => ['/admin/comment/index']],
                    ['label' => 'Order', 'url' => ['/admin/order/index']],
                    ['label' => 'User', 'url' => ['/admin/user/index']],
                    ['label' => 'Logout (' . Yii::$app->user->identity->name . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                    ],
            ];
            $user_widget = [
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Logout (' . Yii::$app->user->identity->name . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ],
            ];
            $guest_widget = [
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Login', 'url' => ['/site/login']],
                    ['label' => 'Registration', 'url' => ['/site/registration']]
                ],
            ];

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => 'Cart ', 'linkOptions' => ['class'=>'cart'], 'url' => ['/cart/view']],
                ],
            ]);

            if (Yii::$app->user->getIdentity()->role == User::ROLE_ADMIN)
                echo Nav::widget($admin_widget);
            else if (Yii::$app->user->isGuest)
                echo Nav::widget($guest_widget);
            else
                echo Nav::widget($user_widget);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
<script>
    <?= CartWidget::widget() ?>
</script>
<script type="text/javascript">
$(document).ready(function(){
//  Stars on prodcut page
    $(".rating input:radio").attr("checked", false);
    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });
});
// End stars

// Review add button
$(document).ready(function(){
    $('#str1').click();
    $('#add-review').click(function(){
        $('#add-review').hide();
        $('#review-form').css('visibility','visible');
        $('#review-form').css('height','5em');
    });
});
// End review add button
</script>
</body>
</html>
<?php $this->endPage() ?>
