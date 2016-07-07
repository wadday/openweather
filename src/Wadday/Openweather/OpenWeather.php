<?php

namespace Wadday\Openweather;

use Wadday\Openweather\Wadday as wcoms;

class OpenWeather
{
	protected $key = "178c57b36348a4feedfef027a7ffd156";
	protected $city = "1282028";
	
	public function get($type)
	{

		if ($type == 1) {
			return $this->simple();
		} 

	}

	public function simple()
	{
		$data = $this->mix();

		$out = $data['country_name'].", ".$data['country_code'];
		$out .= "&nbsp;&nbsp;<i class='".$data['icon_css']."' alt='".$data['description']."' title='".$data['description']."'></i> ";
		$out .= ",&nbsp;".$data['temperature']."°C&nbsp;";
		$out .= ", Humidity: ".$data['humidity'];
		$out .= ",&nbsp;".$data['day'];
		
		return $out;
	}

	private function mix()
	{
		$wcom = new wcoms($this->key, $this->city);
		$content = $wcom->fetch();
		$now = $wcom->data(0, $content);

		return $now;
	}
}
