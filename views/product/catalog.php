<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use app\models\ProductModel;

	$this->title = 'Catalog | WebStore';
?>
<style>
.nav > li > ul.nav > li 
{
	padding-left:1em;
}
</style>
<div class="row">

			<div class="col-md-12">
                <div class="lead col-md-3">Web Store NURE</div>
	                <?php echo $this->render('catalog_breadcrumbs',['category'=>$category, 'parent_categories'=>$parent_categories, 'model'=>$model]);?>
			</div>
            <div class="col-md-3">
            	<?php echo $this->render('catalog_categories_menu',
	            	['products' => $products, 
		        	'categories' => $categories, 
		        	'child_categories' => $child_categories, 
		        	'parent_categories' => $parent_categories,
		        	'current_level_categories' => $current_level_categories, 
		        	'category' => $category]);
		        ?>
            </div>

            <div class="col-md-9">
                <div class="row">
                <?php foreach ($products as $product) {?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="<?='/'.$product->photo?>" alt="">
                            <div class="caption">
                                <h4 class="pull-right"><?=$product->price?> UAH</h4>
                                <h4><a href="<?=Url::to(['/product/view', 'id'=>$product->id])?>"><?=$product->name?></a>
                                </h4>
                                <p><?=mb_substr($product->description,0,300).'...'?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?=$product->getComments()->count()?> reviews</p>
                                <p>
                                	<?php 
                                	$i = 0;
                                	for (; $i<$product->rating; $i++)
                                		echo '<span class="glyphicon glyphicon-star"></span>';
                                	for (; $i<5; $i++)
                                		echo '<span class="glyphicon glyphicon-star-empty"></span>';
                                	?>
                                </p>
                            </div>
                        </div>
                    </div>
                 <?php } ?>
                </div>

            </div>

        </div>
