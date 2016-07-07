<?php

namespace Wadday\Openweather;

class Wadday {

	protected $api;
	protected $city;
	public $units;

	public function __construct($api, $city)
	{
		$this->api 		= $api;
		$this->city 	= $city;
		$this->units = 'metric';
	}

	public function fetch()
	{
		$url_point = "http://api.openweathermap.org/data/2.5/weather?";
		$params = [
			'appid'	=> $this->api,
			'id'	=> $this->city,
			'units'	=> $this->units
		];

		$url = $url_point.http_build_query($params);
		$response = $this->getCurl($url);

		return $response;

	}

	public function getCurl($url)
	{
		if(function_exists('curl_exec')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$response = curl_exec($ch);
			curl_close($ch);
		}

		if (empty($response)) {
			$response = file_get_contents($url);
		}

		return $response;
	}

	/**
	 * @type option to disple minimal or full forcast 
	 * $data The icon will retreive from OWM as default
	 */
	public function data($type, $data = null)
	{
		$data = json_decode($data, true);

		if ($data['cod'] != 200) return false;

		if ($type != 1) {

			//list everything in array to export for more customization
			$list = [
				//cordinates
				'lon'			=> $data['coord']['lon'], 		//lontitude
				'lat'			=> $data['coord']['lat'],		//latitude
				//weather
				'wid'			=> $data['weather'][0]['id'], 	
				'condition'		=> $data['weather'][0]['main'], 
				'description'		=> ucfirst($data['weather'][0]['description']),
				'icon_css'		=> $this->icon_css($data['weather'][0]['id']),
				'icon_img'		=> $this->icon_img($data['weather'][0]['icon']),
				'icon_custom' 		=> $this->icon_custom($data['weather'][0]['icon']),
				
				'base'			=> $data['base'],
				//main
				'temperature'	=> round($data['main']['temp']),
				'pressure'		=> $data['main']['pressure'],
				'humidity' 		=> $data['main']['humidity']."%",
				'min'			=> round($data['main']['temp_min']),
				'max'			=> round($data['main']['temp_max']),
				
				//wind
				'wind_speed'	=> $this->transform(0, $data['wind']['speed']),
				'wind_deg'		=> $data['wind']['deg'],
				//sys
				'message'		=> $data['sys']['message'],
				'country_code'	=> $data['sys']['country'],
				'sunrise'		=> $data['sys']['sunrise'],
				'sunset'		=> $data['sys']['sunset'],
				//general
				'country_id'	=> $data['id'],
				'country_name'	=> $data['name'],
				'code'			=> $data['cod'],
				'date'			=> gmdate("m-d-Y", $data['dt']),
				'day'			=> $this->transform(1, gmdate("w", $data['dt']))
			];
		}

		return $list;
	}

	/**
	 * @param string $icon 
	 * The icon will retreive from OWM as default
	 */
	public function icon_img($icon = null)
	{
		return 'http://openweathermap.org/img/w/'.$icon.'.png';
	}

	/**
	 * @param string $code 
	 * The code will generate css weather icon base on weather code from OWP
	 * Required weathericons.io css
	 */
	public function icon_css($code = null)
	{
		return "wi wi-owm-".$code;
	}

	/**
	 * @code string $icon 
	 * Create your own weather icon in png format and set for day or night
	 * @return 04-day or 04-night in png format
	 */
	public function icon_custom($code = null)
	{
		$val = preg_split('#(?<=\d)(?=[a-z])#i', $code);
		$digit 	= $val[0];
		$text	= $val[1];

		if ($text == "d")
		{
			$output = $digit."-day.png";
		} else {
			$output = $digit."-night.png";
		}

		return $output;
	}

	/**
	 * @param string $data, $type 
	 * transform km/h to mp/h and week days
	 */
	public function transform($type, $data) {
	   /**
		* @param	string	$type	The type of the transformation, 0 for units, 1 for days
		* @param	string	$data	The data to be consumed
		* @return	string
		*/
		
		if($type == 1) {
			$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
			return $days[$data];
		} else {
			if($this->units) {
				return round($data, 2).' mp/h';
			} else {
				// Transform m/s to km/s
				return round($data * 3600 / 1000, 2).' km/h';
			}
		}
	}
}
