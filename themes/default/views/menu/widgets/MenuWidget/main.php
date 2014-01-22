<?php
foreach ($params['items'] as $key => $item) {
	if ($item['url'] && !empty($item['url'][0]) && $item['url'][0] === '/portfolio/portfolio/index') {
		if (Yii::app()->controller->id === 'portfolio') {
			$params['items'][$key]['active'] = true;
			break;
		}
	}
}
?>
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<?php
			$this->widget(
				'bootstrap.widgets.TbMenu',
				array_merge(
					array(),
					$params
				)
			);
			?>
		</div>
	</div>
</div>