<?php
 /**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams ('com_media');
?>
<?php if ($this->params->get('show_page_heading')) : ?>
<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>

<div class="at-contact contact<?php echo $this->pageclass_sfx?>">
	<div class="contact-details" style="<?php if($this->contact->email_to != null && $this->params->get('show_email_form'))?>">
		<?php if ($this->contact->name && $this->params->get('show_name')) : ?>
			<h2>
				<span class="contact-name"><?php echo $this->contact->name; ?></span>
			</h2>
		<?php endif;  ?>
	
		<?php if ($this->params->get('show_contact_category') == 'show_no_link') : ?>
			<h3>
				<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
			</h3>
		<?php endif; ?>
		
		<?php if ($this->params->get('show_contact_category') == 'show_with_link') : ?>
			<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid);?>
			<h3>
				<span class="contact-category"><a href="<?php echo $contactLink; ?>">
					<?php echo $this->escape($this->contact->category_title); ?></a>
				</span>
			</h3>
		<?php endif; ?>
		<?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
			<form action="#" method="get" name="selectForm" id="selectForm">
				<?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>
				<?php echo JHtml::_('select.genericlist',  $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
			</form>
		<?php endif; ?>
		<fieldset>
			
			<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
				<p class="contact-position"><?php echo $this->contact->con_position; ?></p>
			<?php endif; ?>
			
			<?php echo $this->loadTemplate('address');?>
		
			<?php if ($this->params->get('allow_vcard')) :	?>
				<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
					<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id='.$this->contact->id . '&amp;format=vcf'); ?>">
					<?php echo JText::_('COM_CONTACT_VCARD');?></a>
			<?php endif; ?>
		</fieldset>
		
		<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
			<?php  echo $this->loadTemplate('form');  ?>
		<?php endif; ?>
	</div>
	
	<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
		<div class="contact-image">
				<img src="<?php echo JURI::base().$this->contact->image;?>"/>
		</div>
	<?php endif; ?>
	<div class="clearbreak"></div>
	
	<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>	
						<div class="contact-miscinfo">
							<div class="contact-misc">
								<?php echo $this->contact->misc; ?>
							</div>
						</div>
	<?php endif; ?>
	  
	<?php if ($this->params->get('show_links')) : ?>
		<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
			<?php echo '<h3>'. JText::_('JGLOBAL_ARTICLES').'</h3>'; ?>
			<?php echo $this->loadTemplate('articles'); ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<?php echo '<h3>'. JText::_('COM_CONTACT_PROFILE').'</h3>'; ?>
		<?php echo $this->loadTemplate('profile'); ?>
	<?php endif; ?>
	
</div>
