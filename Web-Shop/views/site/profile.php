<?php

use yii\helpers\Html;
// use yii\bootstrap4\DetailView;
use yii\widgets\DetailView;
use slavkovrn\lightbox\LightBoxWidget;
$photoInfo = Yii::$app->user->identity->PhotoInfo;
// var_dump($photoInfo);
$photo = Html::img($photoInfo['url'],['alt'=>$photoInfo['alt']]);
// $options=['data-lightbox'=>'profile-image','data-title'=>$photoInfo['alt']]
?>
<section id="horizontal-form-layouts">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<!-- <div class="card-header">
					<h4 class="card-title" id="horz-layout-basic">User Info</h4>
					
				</div> -->
				<div class="card-content collpase show">
					<div class="card-body">
						<div class="card-text">
							<h1><?= Yii::$app->user->identity->username ?>'s Profile</h1>
						</div>
						<figure>
							<!-- <img src="https://cdn4.iconfinder.com/data/icons/linecon/512/photo-512.png" alt="">	 -->
						
							<?=
							LightBoxWidget::widget([
								'id'     => 'lightbox',  // id of plugin should be unique at page
								'class'  => 'galary',    // class of plugin to define style
								'height' => '100px',     // height of image visible in widget
								'width' => '100px',      // width of image visible in widget
								'images' => [
									1 => [
										'src' => $photoInfo['url'],
										'title' => $photoInfo['alt']
									]

								],
							]);
						?>

							<figcaption>(click to enlarge)</figcaption>
						</figure>
						<!-- <a href="https://cdn4.iconfinder.com/data/icons/linecon/512/photo-512.png" data-lightbox="lightbox" data-title="profile image">
							<img height="100px" width="100px" src="https://cdn4.iconfinder.com/data/icons/linecon/512/photo-512.png" alt="profile image">
						</a> -->
						
						<?= DetailView::widget([
							'model' => Yii::$app->user->identity,
							'attributes' => [
								'username',
								'email',
								'gender',
								'nationality',
								'phone'
							]
						]) ?>

						<p>
							<?= Html::a('Update', ['update', 'id' => Yii::$app->user->identity->id], ['class' => 'btn btn-primary']) ?>

						</p>
					</div>
				</div>
			</div>
		</div>
	</div>






</section>