<? /* @var $model Gallery */ ?>
<div id="carousel_<?= $model->id ?>" class="carousel slide portfolio-gallery">
	<ol class="carousel-indicators">
		<?php for ($i = 0; $i < $model->imagesCount; $i++): ?>
			<li data-target="carousel_<?= $model->id ?>" data-slide-to="<?= $i ?>" class="<?= ($i === 0) ? 'active' : '' ?>"></li>
		<?php endfor; ?>
	</ol>
	<!-- Carousel items -->
	<div class="carousel-inner">
		<?php foreach ($model->images as $key => $image): ?>
			<div class="<?= $key === 0 ? 'active' : '' ?> item">
				<img src="<?= $image->getUrl(1000, 500); ?>" alt="<?= $image->alt ?>" />

				<div class="carousel-caption">
					<h4><?= $image->name ?></h4>

					<p><?= $image->description ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<!-- Carousel nav -->
	<a class="carousel-control left" href="#carousel_<?= $model->id ?>" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#carousel_<?= $model->id ?>" data-slide="next">&rsaquo;</a>
</div>