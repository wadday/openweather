<?php

namespace Wadday\Openweather;

use Wadday\Openweather\Wadday as wcoms;

class OpenWeather
{
	protected $key = "178c57b36348a4feedfef027a7ffd156";
	protected $city = "1282028";
	
	public function get()
	{
		$wcom = new wcoms($this->key, $this->city);
		$content = $wcom->fetch();
		$now = $wcom->data(0, $content);

		return $now['icon_custom'];
	}
}