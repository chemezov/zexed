<? /* @var $model Gallery */ ?>

<div class="clearfix fancybox-gallery">
	<?php foreach ($model->images as $image): ?>
		<a class="fancybox-gallery-item" rel="fancybox-gallery-<?= $model->id ?>" href="<?=
		$image->getUrl() ?>" title="<?= $image->name ?>" data-title-id="title-<?= $image->id ?>"> <img src="<?=
			$image->getUrl(
				178
			) ?>" alt="<?= $image->alt ?>" class="img-polaroid" /> </a>
	<?php endforeach; ?>

	<?php foreach ($model->images as $image): ?>
		<div id="title-<?= $image->id ?>" class="hidden">
			<p><b><?= $image->name ?></b></p>
			<?php if ($image->description): ?>
				<p><?= $image->description ?></p>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>