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
   
   	$data = Openweather::get(1); //simple way formated for website top ribbon

## CSS Icon (with weathericons.io)

## PNG OWM default icons


#Optional Requirements
# 222 Weather Themed Icons and CSS

Weather Icons is the only icon font and CSS with 222 weather themed icons, ready to be dropped right into [Bootstrap](http://www.getbootstrap.com), or any project that needs high quality weather, maritime, and meteorological based icons!

Get started at [http://weathericons.io](http://weathericons.io)!

![Icon Preview](http://i.imgur.com/XmZW2q3.png)

## Basic Usage Default icons

Place the 5 font files and the main `weather-icons.min.css` file in your project, with the assumption that the fonts are located up `../` from your CSS directory.

The icons are displayed by using an `i` element and adding the base class `wi` and then the icon class you want, such as `day-sunny`. This then looks like `<i class="wi wi-day-sunny"></i>`.

To add a modifier, include the class you want after the icon name, which looks like `<i class="wi wi-day-sunny wi-flip-vertical"></i>`. You can flip, rotate, or add a fixed width. See it all at [http://weathericons.io](http://weathericons.io).

## Credit
The icon designs are originally by [Lukas Bischoff](http://www.twitter.com/artill). Icon art for v1.1 forward, HTML, Less, and CSS are by [me (Erik)](http://www.helloerik.com).

## Licensing

* Weather Icons licensed under [SIL OFL 1.1](http://scripts.sil.org/OFL)
* Code licensed under [MIT License](http://opensource.org/licenses/mit-license.html)
* Documentation licensed under [CC BY 3.0](http://creativecommons.org/licenses/by/3.0)
