<?php
/**
 * @copyright	amazing-templates.com
 * @author		Tran Nam Chung
 * @mail		chungtn2910@gmail.com
 * @link		http://www.amazing-templates.com
 * @license		License GNU General Public License version 2 or later
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// Include the syndicate functions only once
require_once( dirname(__FILE__).DIRECTORY_SEPARATOR.'helper.php' );
//$ = mod_avatar_youtubeHelper::get($params);
$width = mod_avatar_youtubeHelper::getwidth($params);
$height = mod_avatar_youtubeHelper::getheight($params);
$source = mod_avatar_youtubeHelper::getsource($params);
$cr = mod_avatar_youtubeHelper::getcr($params);
if($source == 'youtube')
{
	//$ = mod_avatar_youtubeHelper::get($params);
	$youtubeType = mod_avatar_youtubeHelper::getyoutubeType($params);
	$input = mod_avatar_youtubeHelper::getinput($params);
	$start = mod_avatar_youtubeHelper::getstart($params);
	$theme = mod_avatar_youtubeHelper::gettheme($params);
	$color = mod_avatar_youtubeHelper::getcolor($params);
	$autoHide = mod_avatar_youtubeHelper::getautoHide($params);
	$autoPlay = mod_avatar_youtubeHelper::getautoPlay($params);
	$ccLoadPolicy = mod_avatar_youtubeHelper::getccLoadPolicy($params);
	$controls = mod_avatar_youtubeHelper::getcontrols($params);
	$enableJSAPI = mod_avatar_youtubeHelper::getenableJSAPI($params);
	$fs = mod_avatar_youtubeHelper::getfs($params);
	$ivLoadPolicy = mod_avatar_youtubeHelper::getivLoadPolicy($params);
	$loop = mod_avatar_youtubeHelper::getloop($params);
	$rel = mod_avatar_youtubeHelper::getrel($params);
	$showInfo = mod_avatar_youtubeHelper::getshowInfo($params);
	$logo = mod_avatar_youtubeHelper::getlogo($params);
}
else 
{
	$vimeoInput = mod_avatar_youtubeHelper::getvimeoInput($params);
	$vimeoColor = mod_avatar_youtubeHelper::getvimeoColor($params);
	$vimeoTitle = mod_avatar_youtubeHelper::getvimeoTitle($params);
	$vimeoByLine = mod_avatar_youtubeHelper::getvimeoByLine($params);
	$vimeoPortrait = mod_avatar_youtubeHelper::getvimeoPortrait($params);
	$vimeoFS = mod_avatar_youtubeHelper::getvimeoFS($params);
	$vimeoAutoPlay = mod_avatar_youtubeHelper::getvimeoAutoPlay($params);
	$vimeoLoop = mod_avatar_youtubeHelper::getvimeoLoop($params);
	$vimeoAPI = mod_avatar_youtubeHelper::getvimeoAPI($params);
}
require( JModuleHelper::getLayoutPath( 'mod_avatar_youtube' ) );
?>