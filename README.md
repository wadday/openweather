# openweather
Simple APi Tweaks from [OpenWeatherMap](http://openweathermap.org).

##Installation

Via Composer

    $ composer require wadday/openweather:dev-master
    
##Service Provider
    'Wadday\Openweather\OpenweatherServiceProvider'
    
##Facade
    'Openweather' => 'Wadday\Openweather\Facades\Openweather'
    

# Usage
Get current weather.

	use Openweather;
   
   	$data = Openweather::get();

 
