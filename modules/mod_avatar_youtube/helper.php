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
class mod_avatar_youtubeHelper
{
	public static function getsource($params){return $params->get('source');}
    public static function getwidth($params){return $params->get('width');}
    public static function getheight($params){return $params->get('height');}
	public static function getcr($params){return $params->get('cr');}
    public static function getyoutubeType($params){return $params->get('youtubeType');}
    public static function getinput($params){return $params->get('input');}
    public static function getstart($params){return $params->get('start');}
    public static function gettheme($params){return $params->get('theme');}
    public static function getcolor($params){return $params->get('color');}
    public static function getautoHide($params){return $params->get('autoHide');}
    public static function getautoPlay($params){return $params->get('autoPlay');}
    public static function getccLoadPolicy($params){return $params->get('ccLoadPolicy');}
    public static function getcontrols($params){return $params->get('controls');}
	public static function getenableJSAPI($params){return $params->get('enableJSAPI');}
    public static function getfs($params){return $params->get('fs');}
    public static function getivLoadPolicy($params){return $params->get('ivLoadPolicy');}
    public static function getloop($params){return $params->get('loop');}
    public static function getrel($params){return $params->get('rel');}
    public static function getshowInfo($params){return $params->get('showInfo');}
    public static function getlogo($params){return $params->get('logo');}
    public static function getvimeoInput($params){return $params->get('vimeoInput');}
    public static function getvimeoColor($params){return $params->get('vimeoColor');}
    public static function getvimeoTitle($params){return $params->get('vimeoTitle');}
    public static function getvimeoByLine($params){return $params->get('vimeoByLine');}
    public static function getvimeoPortrait($params){return $params->get('vimeoPortrait');}
    public static function getvimeoFS($params){return $params->get('vimeoFS');}
    public static function getvimeoAutoPlay($params){return $params->get('vimeoAutoPlay');}
    public static function getvimeoLoop($params){return $params->get('vimeoLoop');}
    public static function getvimeoAPI($params){return $params->get('vimeoAPI');}

    //public static function get($params){return $params->get('');}
}
?>