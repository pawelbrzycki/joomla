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
$document = JFactory::getDocument();
echo "<div style='width:".$width."'>";
if($source == "youtube")
{
	$url = "https://www.youtube.com/v/";
	$url .= "videoseries?listType=search&amp;list=".urlencode($input)."&amp;autoplay=".urlencode($autoPlay);
	$url .= "&amp;version=3&amp;feature=player_embedded&amp;fs=".urlencode($fs)."&amp;loop=".urlencode($loop)."&amp;start=".urlencode($start);
?>
<object style="width: 100%;" height="<?php echo $height;?>" data="<?php echo trim($url); ?>" >
<param name="allowFullScreen" value="true" />
<param name="allowScriptAccess" value="always" />
<embed 
	src="<?php echo $url; ?>"
	type="application/x-shockwave-flash" 
	allowfullscreen="true" 
	allowScriptAccess="always" 
	width="100" 
	height="<?php echo $height;?>" />
</object>
<?php
}
else
{
	$colorTmp = explode("#", $vimeoColor);
	$tmp = $colorTmp[1];
	$url = "http://vimeo.com/moogaloop.swf?clip_id=".urlencode($vimeoInput)."&amp;server=vimeo.com&amp;color=".urlencode($tmp)."&amp;fullscreen=".urlencode($vimeoFS)."&amp;title=".($vimeoTitle)."&amp;byline=".urlencode($vimeoByLine)."&amp;portrait=".urlencode($vimeoPortrait)."&amp;autoplay=".urlencode($vimeoAutoPlay)."&amp;loop=".urlencode($vimeoLoop)."&amp;api=".urlencode($vimeoAPI);
?>
<object style="width: 100%;" height="<?php echo $height;?>" data="<?php echo trim($url); ?>">
    <param name="allowfullscreen" value="true" />
    <param name="allowscriptaccess" value="always" />
    <embed 
    	src="<?php echo $url;?>" 
    	type="application/x-shockwave-flash" 
    	allowfullscreen="true" 
    	allowscriptaccess="always" 
    	width="100" 
    	height="<?php echo $height;?>" />
</object>
<?php	
}?>
<div class="avatar-copyright" style="width:100%;margin: 5px;text-align: center;">
&copy; Amazing-Templates.com
	<a target="_blank" href="http://www.amazing-templates.com" title="Joomla Template &amp; Extension">Joomla Extension</a>-
	<a target="_blank" href="http://www.amazing-templates.com" title="Joomla Template &amp; Extension">Joomla Template</a>
</div>