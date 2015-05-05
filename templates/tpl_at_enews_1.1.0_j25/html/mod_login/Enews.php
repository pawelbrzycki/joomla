<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>
<div class="at-enews-login">
	<?php if ($type == 'logout') : ?>
	<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
	<?php if ($params->get('greeting')) : ?>
		<div class="login-greeting">
		<?php if($params->get('name') == 0) : {
			echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
		} else : {
			echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
		} endif; ?>
		</div>
	<?php endif; ?>
		<div class="logout-button">
			<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGOUT'); ?>" />
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.logout" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
	<?php else : ?>
	<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
		<?php if ($params->get('pretext')): ?>
			<div class="pretext">
			<p><?php echo $params->get('pretext'); ?></p>
			</div>
		<?php endif; ?>
		<fieldset class="userdata">
		<div id="form-login-username">
			<input id="modlgn-username" type="text" name="username" class="inputbox"  size="18" value="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
		</div>
		<div id="form-login-password">
			<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18" value="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
		</div>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<div id="form-login-button">
			<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
		</div>
		<?php echo JHtml::_('form.token'); ?>
		
		<?php
		$usersConfig = JComponentHelper::getParams('com_users');
		if ($usersConfig->get('allowUserRegistration')) : ?>
		<div class="at-enews-registration">
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
				<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
		</div>
		<?php endif; ?>
		</fieldset>
		
		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<div id="form-login-remember">
			<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
			<label for="modlgn-remember"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
		</div>
		<?php endif; ?>
		
		
		<?php if ($params->get('posttext')): ?>
			<div class="posttext">
			<p><?php echo $params->get('posttext'); ?></p>
			</div>
		<?php endif; ?>
		<div class="clr"></div>
	</form>
</div>
<?php endif; ?>
