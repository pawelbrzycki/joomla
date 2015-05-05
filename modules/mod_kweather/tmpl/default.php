<?php
    /*------------------------------------------------------------------------
    # mod_kweather - Weather Module by Kaleidoscoop-web.com
    # ------------------------------------------------------------------------
    # Author    Paul van Haren http://www.kaleidoscoop-web.com
    # Copyright (C) 2012 - 2013 Kaleidoscoop
    #
    -------------------------------------------------------------------------*/

    // no direct access
    defined( '_JEXEC' ) or die( 'Restricted access' );

$weather = $data['weather']['current_observation'];
$forecast = $data['weather']['forecast']['simpleforecast']['forecastday'];

$iconRoot = JURI::root() . 'media/mod_kweather/icons/'.$params->get('iconset').'/';
$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'modules/mod_kweather/assets/css/mod_kweather.css');
?>

<div id="weather_k1_id<?php echo $moduleID; ?>" class="weather_k1">

	<div class="weather_k1_c">
		<div class="weather_k1_cleft">
			<img class="kw_icon_big" src="<?php echo $iconRoot . $helper->getIcon($weather['icon']); ?>" title="<?php echo ''; ?>" alt="<?php echo ''; ?>"/>
			<p class="kw_current_temp">
				<?php echo $weather['ktemp']; ?>
			</p>
		</div>
		<div class="weather_k1_cright">
		        <?php if($params->get('city')==1) { ?>
				<p class="weather_k1_city"><?php echo $params->get('locationName'); ?></p>
			<?php } ?>
			
			<?php if($params->get('condition')==1) { ?>
				<div class="kw_row"><?php echo $weather['weather']; ?></div>
			<?php } ?>
			
			<?php if($params->get('humidity')==1) { ?>
				<div class="kw_row"><?php echo JText::_('KWEATHER_HUMIDITY') . ': ' . $weather['relative_humidity']; ?>	</div>
			<?php } ?>
			
			<?php if($params->get('wind')==1) { ?>
				<div class="kw_row"><?php echo JText::_('KWEATHER_WIND') . ': ' . $weather['wind_dir']. 
				' ' . JText::_('KWEATHER_AT') . ' ' . $weather['kwind']; ?></div>
			<?php } ?>
		</div>
		<div class="kw_logo"><a href="http://www.wunderground.com/?apiref=4d529619c9f1e55e" target="_blank"><img src="modules/mod_kweather/assets/images/Wunderground-logo/<?php echo $params->get('wlogo'); ?>"
			title="Wunderground" width="126px" /></a>
		</div>

		<div style="clear:both"></div>		
	</div>
	<div style="clear:both"></div>
	<?php 

		if ($params->get('forecast')!='disabled' & $params->get('forecast') != null) {
		      	$fcast = $params->get('forecast');
		      	echo '<div class="weather_k1_forecasts">';
			for ($i = 1; $i < $fcast + 1; $i++) {
				if ($params->get('layout')=='list') { 
				      // list layout
				      	echo '<div class="list_'. ($i%2 ? 'even' : 'odd'). '">';
					echo '<span class="weather_k1_list_day">'. $forecast[$i]['date']['weekday'].'</span>';
					echo '<span class="weather_k1_list_temp">'. $forecast[$i]['low']['string']. $params->get('separator') . $forecast[$i]['high']['string'] .'</span>';
					echo '<span class="weather_k1_list_icon"><img class="kw_icon" src="' . $iconRoot . $helper->getIcon($forecast[$i]['icon']) . '"/></span>';		
					echo '<div style="clear:both"></div></div>';
				} else	{	
					// block layout
					echo '<div class="block_'. ($i%2 ? 'even' : 'odd') .'" style="float:left;width:'.round(100/$fcast).'%">';
					echo '<span class="weather_k1_day">'. $forecast[$i]['date']['weekday'].'</span>';
					echo '<br style="clear:both" />';
					echo '<span class="weather_k1_icon"><img class="kw_icon" src="' . $iconRoot . $helper->getIcon($forecast[$i]['icon']) . '"/></span>';		
					echo '<br style="clear:both" />';
					echo '<span class="weather_k1_temp">'. $forecast[$i]['low']['string']. $params->get('separator') . $forecast[$i]['high']['string'] .'</span>';
					echo '</div>';
				}
			}
			echo '</div>';
		}
	 ?>
    <div style="display:none">KWeather is powered by <a href="http://kaleidoscoop-web.com">Kaleidoscoop</a></div>
    <div style="clear:both"></div>
</div>


