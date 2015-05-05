<?php
    /*------------------------------------------------------------------------
    # mod_kweather - Weather Module by Kaleidoscoop-web.com
    # ------------------------------------------------------------------------
    # Author    Paul van Haren http://www.kaleidoscoop-web.com
    # Email	info@kaleidoscoop-web.com
    # Copyright (C) 2013 Kaleidoscoop
    -------------------------------------------------------------------------*/
    
// no direct access
defined('_JEXEC') or die('Restricted access');    
$moduleName             = basename(dirname(__FILE__));
$moduleID               = $module->id;
$document               = JFactory::getDocument();
$cssFile                = JPATH_THEMES. '/'.$document->template.'/css/'.$moduleName.'.css';

//Include helper.php
require_once (dirname(__FILE__).'/helper.php');
$helper 		    = new modKWeatherHelper($params,$moduleID);
$data               = $helper->getData();

if(  is_array( $helper->error() )  )
{
    JFactory::getApplication()->enqueueMessage( implode('<br /><br />', $helper->error()) , 'error');
} else {
    if(file_exists($cssFile)) {
	$document->addStylesheet(JURI::base(true) . '/templates/'.$document->template.'/css/'. $moduleName. '.css');
    } else {
	$document->addStylesheet(JURI::base(true) . '/modules/'.$moduleName.'/assets/css/' . $moduleName . '.css');
    }
    require(JModuleHelper::getLayoutPath($moduleName));
}