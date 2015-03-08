<?php

/**
 * Class SepiaImages
 * for generating sepia toned images. Use $Image.Sepia in your template.
 */
class SepiaImages  extends DataExtension {

	private static $brightness = -30;

	private static $colorize_red = 90;
	private static $colorize_green = 55;
	private static $colorize_blue = 30;


	public function Sepia() {
		return $this->owner->getFormattedImage('Sepia');
	}

	public function generateSepia($gd) {
		$imageResource= $gd->getImageResource();
		if(!$imageResource) return;

		$conf = Config::inst()->forClass('SepiaImages');

		imagefilter($imageResource, IMG_FILTER_GRAYSCALE);
		imagefilter($imageResource, IMG_FILTER_BRIGHTNESS, $conf->get('brightness'));
		imagefilter($imageResource, IMG_FILTER_COLORIZE,
			$conf->get('colorize_red'), $conf->get('colorize_green'), $conf->get('colorize_blue'));

		$output = clone $gd;
		$output->setImageResource($imageResource);

		return $output;
	}
}
