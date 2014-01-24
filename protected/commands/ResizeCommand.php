<?php

/**
 * class ResizeCommand
 *
 * Консольная команда для yiic. Ресайзит изображения, находящиеся в папке uploads/resize. Помещает новые изображения в папку uploads/resize/result
 */
class ResizeCommand extends CConsoleCommand
{
	public function actionIndex($width = 1070)
	{
		error_reporting(E_ALL);
		$processed_count = 0;
		$count = 0;

		$total_start = microtime(true);

		$source_path = dirname(Yii::app()->getBasePath()) . '/uploads/resize';
		$dest_path = dirname(Yii::app()->getBasePath()) . '/uploads/resize/result';

		array_map('unlink', glob($dest_path . DIRECTORY_SEPARATOR . '*'));
		@rmdir($dest_path);

		$files = glob($source_path . DIRECTORY_SEPARATOR . '*.jpg');

		@mkdir($dest_path);

		$count = count($files);

		foreach ($files as $file) {
			$this->updateStatus($processed_count, $count, microtime(true) - $total_start);
			/* @var $image CImage */
			$image = Yii::app()->image->load($file);

			$image->crop(1070, 10000, 0)->quality(100)->save(
				$dest_path . DIRECTORY_SEPARATOR . pathinfo($file, PATHINFO_BASENAME)
			);

			$processed_count++;
		}

		$this->log('Total time: ', microtime(true) - $total_start);
	}

	protected function updateStatus($processed, $count, $total_time)
	{
		$percent = round($processed / $count * 100);
		$time_remaining = $percent ? round((100 / $percent * $total_time) - $total_time, 2) : '-';

		$this->status(
			"Processed " . $processed . ' / ' . $count . ' | Time ' . $this->formatTime(
				$total_time
			) . ' | Time remaining ' . $this->formatTime($time_remaining) . ' | ' . $percent . '%'
		);
	}

	protected function formatTime($time)
	{
		return ($time > 60) ? floor(round($time) / 60) . ' min ' . round($time) % 60 . ' sec' : round($time, 2) . ' sec';
	}

	protected function status($message)
	{
		echo str_pad("[" . $message . "]", 100) . "\r";
	}

	protected function log($message, $time = false)
	{
		echo str_pad(str_pad($message, 40) . ($time !== false ? round($time, 4) . ' sec' : ''), 100) . PHP_EOL;
	}
}