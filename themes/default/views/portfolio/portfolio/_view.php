<?php /* @var $data Portfolio */ ?>
<li>
	<div class="row-fluid">
		<div class="span8">
			<p class="title"><a href="<?= $data->url ?>"><?= $data->name ?></a><span class="label label-success"><?= $data->getStatus() ?></span></p>
		</div>

		<div class="span4">
			<div class="visible-phone">
				<p class="date muted text-left"><?= $data->date ?></p>
			</div>
			<div class="hidden-phone">
				<p class="date muted text-right"><?= $data->date ?></p>
			</div>
		</div>
	</div>

	<p class="description"><?= $data->short_description ?></p>

	<?php if ($data->image): ?>
		<a href="<?= $data->url ?>"> <img class="img-polaroid" src="<?= $data->getImageUrl(2) ?>" alt="<?= $data->name ?>" width="990" /> </a>
	<?php endif; ?>

	<div class="row-fluid link-block">
		<a class="btn btn-primary pull-right" href="<?= $data->url ?>">Подробнее&nbsp;&raquo;</a>
	</div>
</li>
