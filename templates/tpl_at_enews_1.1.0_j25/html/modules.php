<?php
/**
 * @version		$Id: coolfeed.php 100 2012-04-14 17:42:51Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 * @package		Avatar Dream Framework Template
 * @facebook 	http://www.facebook.com/pages/JoomAvatar/120705031368683
 * @twitter	    https://twitter.com/#!/JoomAvatar
 * @support 	http://joomavatar.com/forum/
 */

// No direct access
defined('_JEXEC') or die;

function modChrome_avatarmodule($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<div class="avatar-module <?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
		<?php if ($module->showtitle != 0) : ?>
			<<?php echo $params->get('header_tag', 'h4');?> class="avatar-module-heading"><span></spam><span><?php echo $module->title; ?></span></span></<?php echo $params->get('header_tag', 'h4');?>>
		<?php endif; ?>
			<div class="avatar-module-content">
				<div>
					<?php echo $module->content; ?>
				</div>
			</div>
		</div>
	<?php endif;
}

