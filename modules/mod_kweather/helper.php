<?php
/*------------------------------------------------------------------------
 # mod_kweather - Weather Module by Kaleidoscoop-web.com
# ------------------------------------------------------------------------
# Author    Paul van Haren http://www.kaleidoscoop-web.com
# E-mail:	info@kaleidoscoop-web.com
# Copyright (C) 2013 Kaleidoscoop
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');


class modKWeatherHelper
{
	private $data = array();
	private $forecast = array();
	private $woeid;
	private $location;
	private $params;
	private $moduleID;
	private $moduledir;
	private $iconURL;

	/**
	 * Init Class Params
	 *
	 * @param object $params
	 * @param int $id
	 */
	public function __construct($params, $id)
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		$this->params    	= $params;
		$this->moduleID  	= $id;
		$this->moduledir 	= basename(dirname(__FILE__));
		$this->iconURL 		= JURI::root(false) . '/media/' . $this->moduledir . '/icons/' . $params->get('iconset') . '/%d.png';
		$lang 				= JFactory::getDocument()->getLanguage();
		$this->data['language'] = $this->translateLanguageCode($lang);
		$this->data['weather'] 	= $this->getWeatherData();

	}

	/**
	 * Error Container array
	 *
	 * @var array
	 */
	private $errors = array();

	/**
	 * Get Errors, If index is null errors stored as numeric array.
	 *
	 * @param int | string $index    default is NULL
	 * @return mixed
	 */
	public function error($index=null)
	{
		if( !empty($this->errors) )
		{
			if( is_null($index) ) return  $this->errors;
			else
			{
				if( is_null($this->errors[$index]) ) return false;
				else return  $this->errors[$index];
			}
		}
		else return false;
	}


	/**
	 * Set errors in error variable. If index is null errors stored as numeric array.
	 *
	 * @param mixed $msg
	 * @param mixed $index     default is null.
	 */
	public function setError($msg, $index=null)
	{
		if( is_null($index) ) $this->errors[] = $msg;
		else $this->errors[$index] = $msg;
	}

	private $Joomla2Wunderground = array (
			'af-za' => 'AF',	// Afrikaans
			'sq-al' => 'AL', 	// Albanian
			'ar-aa' => 'AR', 	// Arabic unitag
			'hy-am' => 'HY', 	// Armenian
			'az-az' => 'AZ', 	// Azeri
			'eu-es' => 'EU', 	// Basque
			'be-by' => 'BY',	// Belarusian
			// 'bn-bd' => '',	// Bengali
			// 'bs-ba' => '', 	// Bosnian
			'bg-bg' => 'BU', 	// Bulgarian
			'ca-es' => 'CA',	// Catalan
			'ckb-iq' => 'KU', 	// Central Kurdish
			'zh-cn' => 'CN', 	// Chine simplified
			'zh-tw' => 'TW',	// Chinese traditional
			'hr-hr' => 'CR', 	// Croation
			'cs-cz' => 'CZ',	// Czech
			'da-dk' => 'DK', 	// Danish
			'nl-nl' => 'NL', 	// Dutch
			'en-au' => 'EN', 	// English Australia
			'en-gb' => 'EN',	// Queen's English
			'en-us' => 'EN', 	// English US
			'eo-xx' => 'EO', 	// Esperanto
			'et-ee' => 'ET', 	// Estonian
			'fi-fi' => 'FI', 	// Finnish
			'nl-be' => 'NL', 	// Flemish
			'fr-fr' => 'FR', 	// French
			'gl-es' => 'GZ', 	// Galcian
			'ka-ge' => 'KA',	// Georgian
			'de-de' => 'DL', 	// German
			'de-at' => 'DL',	// German
			'el-gr' => 'GR', 	// Greek
			'he-il' => 'IL',	// Hebrew
			'hi-in' => 'HI',	// Hindi
			'hu-hu' => 'HU', 	// Hungarian
			'id-id' => 'ID', 	// Indonesian
			'it-it' => 'IT', 	// Italian
			'ja-jp' => 'JP',	// Japanese
			'km-kh' => 'KM', 	// Khmer
			'ko-kr' => 'KR', 	// Korean
			// 'lo-la' => '', 	// Loation
			'lv-lv' => 'LV', 	// Latvian
			'lt-lt' => 'LT', 	// Lithuanian
			'mk-mk' => 'MK',	// Macedonian
			// 'ml-in' => '', 	// Malayalam
			'mn-mn' => 'MN',	// Mongolian
			'nb-no' => 'NO',	// Norwegian
			'nn-no' => 'NO', 	// Norwegian
			'fa-ir' => 'FA',	// Persian
			'pl-pl' => 'PL',	// Polish
			'pt-br'	=> 'BR',	// Portuguese Brazil
			'pt-pt' => 'BR',	// Portuuese
			'ro-ro' => 'RO',	// Romanian
			'ru-ru' => 'RU', 	// Russian
			// 'gd-gb' => '', 	// Scottish Gaelic
			// 'sr-rs'	=> '',	// Serbian Cyrillic
			'sr-yu' => 'SR',	// Serbian Latin
			'sk-sk' => 'SK', 	// Slovak
			'es-es' => 'EN',	// Spanish
			'sw-ke' => 'SI',	// Swahili
			'sv-se' => 'SW', 	// Swedish
			// 'sy-iq' => '',	// Syriac
			// 'ta-in' => '', 	// Tamil
			'th-th' => 'TH',	// Thai
			'tr-tr' => 'TR',	// Turkish
			'uk-ua' => 'UA', 	// Ukrainian
			// 'ur-pk' => '', 	// Urdu
			// 'ug-cn'	=> '',	// Uyghur
			'vi-vn' => 'VU', 	// Vietnamese
			'cy-gb' => 'CY', 	// Welsh
	);
	
	private function translateLanguageCode($language) {
		$l = strtolower($language);
		$l = $this->Joomla2Wunderground[$l];
		if(isset($l)) {
			return $l;
		}else{
			return 'EN';	// default
		}
	}
	
	private $weatherImages = array (
			'chanceflurries' 		=> '24.png',
			'chancerain' 			=> '2.png',
			'chancesleet' 			=> '6.png',
			'chancesnow' 			=> '14.png',
			'chancetstorms' 		=> '23.png',
			'clear' 				=> '32.png',
			'cloudy' 				=> '26.png',
			'flurries' 				=> '2.png',
			'fog' 					=> '20.png',
			'hazy' 					=> '21.png',
			'mostlycloudy' 			=> '28.png',
			'mostlysunny' 			=> '34.png',
			'partlycloudy' 			=> '30.png',
			'partlysunny' 			=> '34.png',
			'sleet' 				=> '18.png',
			'rain' 					=> '11.png',
			'snow' 					=> '16.png',
			'sunny' 				=> '32.png',
			'tstorms' 				=> '1.png',
			'nt_chanceflurries' 	=> '24.png',
			'nt_chancerain' 		=> '2.png',
			'nt_chancesleet' 		=> '6.png',
			'nt_chancesnow' 		=> '14.png',
			'nt_chancetstorms' 		=> '23.png',
			'nt_clear' 				=> '31.png',
			'nt_cloudy' 			=> '26.png',
			'nt_flurries' 			=> '2.png',
			'nt_fog' 				=> '20.png',
			'nt_hazy' 				=> '21.png',
			'nt_mostlycloudy' 		=> '27.png',
			'nt_mostlysunny' 		=> '33.png',
			'nt_partlycloudy' 		=> '29.png',
			'nt_partlysunny' 		=> '33.png',
			'nt_sleet' 				=> '18.png',
			'nt_rain' 				=> '11.png',
			'nt_snow' 				=> '16.png',
			'nt_sunny' 				=> '31.png',
			'nt_tstorms' 			=> '1.png',
			'unknown'				=> 'na.png'
	);

	public function getIcon($name) {
		$n = trim($name);

		if (isset($this->weatherImages[$n])) {
			return $this->weatherImages[$n];
		}else{
			return $this->weatherImages['unknown'];
		}
	}
	
	/**
	 * Get Weather data
	 *
	 */
	private function getWeatherData()
	{
		$features = array('conditions','forecast','forecast10day');
		$loc = str_replace(' ','',$this->params->get('location'));
		if(strlen($loc) < 7){
			$this->setError('Location is not properly set in "'.$this->moduledir. '"');
			return;
		}
		$key = trim($this->params->get('wunderground_key'));
		
		if(strlen($key)!= 16) {
			$this->setError('Wunderground key is incorrect in"' . $this->moduledir.'"');
			return;
		} 
		$url = 'http://api.wunderground.com/api/'. $key . '/' . implode($features,'/') .
		'/lang:' . $this->data['language'] . '/q/'. $loc . '.json';

		$cache = JFactory::getCache('KWeather', '');
		// always enable caching for this component independent of system settings
		$cache->setCaching(true);
		$cache->gc();
		$cacheId = serialize($url);

		if(!$data = $cache->get($cacheId)) {
			$response = $this->getCurl($url);
			$data = json_decode($response, true);
			$this->formatWeatherData($data);
			$cache->store($data, $cacheId);
		}

		return $data;
	}

	private function formatWeatherData(&$data) {
		if ($this->params->get('tempUnits') == "c"){
			$this->num2temp = 'num2Celsius';
			$this->selectTemp = 'selectCelsius';
		}else {
			$this->num2temp = 'num2Fahrenheit';
			$this->selectTemp = 'selectFahrenheit';
		}
		
		if ($this->params->get('lengthUnits') == "k"){
			$this->num2speed = 'num2kmh';
			$this->num2pressure = 'num2mbar';
			$this->selectSpeed = 'selectKph';
		}else {
			$this->num2speed = 'num2mph';
			$this->num2pressure = 'num2in';
			$this->selectSpeed = 'selectMph';
		}
		
		if(isset($data['current_observation'])) {
			$this->formatCurrentObservation($data['current_observation']);
		}
		
		
		if(isset($data['forecast']['simpleforecast'])) {
			$this->formatSimpleForecast($data['forecast']['simpleforecast']);
		}
	}
	
	private $convertConditions = array(
			array ('label' => 'temp', 'converter' => 'num2temp'),
			array ('label' => 'feelslike', 'converter' => 'num2temp'),
			array ('label' => 'wind', 'converter' => 'num2speed'),
			array ('label' => 'wind_gust', 'converter' => 'num2speed')
		);
	
	private function formatCurrentObservation(&$data) {
		foreach ($this->convertConditions as $c) {
			$f = $this->$c['converter'];
			$data['k'.$c['label']] = $this->$f($data, $c['label']);
		}
	}
	
	private $convertForecast = array(
			array ('label' => 'high', 'converter' => 'selectTemp'),
			array ('label' => 'low', 'converter' => 'selectTemp')
		);
				
			
	private function formatSimpleForecast(&$data) {
		for($i = 0; true; $i++) {
			if (!isset($data['forecastday'][$i])) {
				break;
			}
			foreach($this->convertForecast as $c) {
				$f = $this->$c['converter'];
				$data['forecastday'][$i][$c['label']]['string'] = $this->$f($data['forecastday'][$i][$c['label']]);
			}
		}
	}
	
	private $num2temp;
	private $num2speed;
	private $num2pressure;
	
	private $selectTemp;
	private $selectSpeed;
	
	private function num2Celsius($data, $label) {
		return $data[$label . '_c'] . '&deg;C';
	}
	private function num2Fahrenheit($data, $label) {
		return $data[$label . '_f'] . '&deg;F';		
	}
	private function num2kmh($data, $label) {
		return $data[$label . '_kph'] . '&nbsp;kmh';
	}
	private function num2mph($data, $label) {
		return $data[$label . '_mph'] . '&nbsp;mph';
	}
	private function num2mbar($data, $label) {
		return $data[$label . '_mb'] . '&nbsp;mb';
	}
	private function num2in($data, $label) {
		return $data[$label . '_in'] . '&nbsp;in';
	}
	private function num2mm($data, $label) {
		return $data[$label . '_metric'] . '&nbsp;mm';
	}
	
	private function selectCelsius($data) {
		return $data['celsius'] . '&deg;C';
	}
	private function selectFahrenheit($data) {
		return $data['fahrenheit'] . '&deg;F';
	}
	private function selectMm($data) {
		return $data['mm'] . '&nbsp;mm';
	}
	private function selectCm($data) {
		return $data['cm'] . '&nbsp;cm';
	}
	private function selectIn($data) {
		return $data['in'] . '&nbsp;in';
	}
	private function selectKph($data) {
		return $data['kph'] . '&nbsp;kmh';
	}
	private function selectMph($data) {
		return $data['mph'] . '&nbsp;mph';
	}
	
        /**
        * PHP CURL function
        * 
        * @param string $url
        * @param array $query   default is array
        * @return string
        */
        private function getCurl($url)
        {
            if (function_exists('curl_init'))
            {
                // initializing connection
                $curl = curl_init();
                // saves us before putting directly results of request
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                // url to get
                curl_setopt($curl, CURLOPT_URL, $url );
                // timeout in seconds
                curl_setopt($curl, CURLOPT_TIMEOUT, 60);
                // set useragent
                curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                if( strtolower(substr( $url , 0, 5))==='https' )
                {
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
                }
                // execute curl
                $data = curl_exec($curl);
                // closing connection
                $error = trim(curl_error($curl)); 
                curl_close($curl);
                if( !empty($error) ) $this->setError('"'.$error.'" in module "'.$this->moduledir.'"');
                return $data;
            }
            else
            {
                $this->setError('cURL extension is not available on your server.  in module "'.$this->moduledir.'"');
            }
        }

	
	/**
	 * get Data
	 *
	 */
	function getData() {
		return $this->data;
	}

}
