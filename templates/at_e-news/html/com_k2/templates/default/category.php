<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<!-- Start K2 Category Layout -->
<div id="k2Container" class="at-news itemListView <?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
	<div class="at-main-border">
		<?php if($this->params->get('show_page_title')): ?>
		<!-- Page title -->
		<h1 class="at-page-heading <?php echo $this->params->get('pageclass_sfx')?>">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</h1>
		<?php endif; ?>
	
		<?php if($this->params->get('catFeedIcon')): ?>
		<!-- RSS feed icon -->
		<div class="k2FeedIcon">
			<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
				<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
			</a>
			<div class="clr"></div>
		</div>
		<?php endif; ?>
	
		<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
		<!-- Blocks for current category and subcategories -->
		<div class="itemListCategoriesBlock">
	
			<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
			<!-- Category block -->
			<div class="itemListCategory">
	
				<?php if(isset($this->addLink)): ?>
				<!-- Item add link -->
				<span class="catItemAddLink">
					<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $this->addLink; ?>">
						<?php echo JText::_('K2_ADD_A_NEW_ITEM_IN_THIS_CATEGORY'); ?>
					</a>
				</span>
				<?php endif; ?>
	
				<?php if($this->params->get('catTitle')): ?>
				<!-- Category title -->
				<h2 class="at-news-k2-category-title"><?php echo $this->category->name; ?></h2>
				<?php endif; ?>
				
				<?php if($this->params->get('catImage') && $this->category->image): ?>
				<!-- Category image -->
				<img alt="<?php echo K2HelperUtilities::cleanHtml($this->category->name); ?>" src="<?php echo $this->category->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
				<?php endif; ?>	
	
				<?php if($this->params->get('catDescription')): ?>
				<!-- Category description -->
				<p><?php echo $this->category->description; ?></p>
				<?php endif; ?>
	
				<!-- K2 Plugins: K2CategoryDisplay -->
				<?php echo $this->category->event->K2CategoryDisplay; ?>
	
				<div class="clr"></div>
			</div>
			<?php endif; ?>
	
			<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
			<!-- Subcategories -->
			<div class="itemListSubCategories">
				<h3><?php echo JText::_('K2_CHILDREN_CATEGORIES'); ?></h3>
	
				<?php foreach($this->subCategories as $key=>$subCategory): ?>
	
				<?php
				// Define a CSS class for the last container on each row
				if( (($key+1)%($this->params->get('subCatColumns'))==0))
					$lastContainer= ' subCategoryContainerLast';
				else
					$lastContainer='';
				?>
	
				<div class="subCategoryContainer<?php echo $lastContainer; ?>"<?php echo (count($this->subCategories)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('subCatColumns'), 1).'%;"'; ?>>
					<div class="subCategory">
						<?php if($this->params->get('subCatImage') && $subCategory->image): ?>
						<!-- Subcategory image -->
						<a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
							<img alt="<?php echo K2HelperUtilities::cleanHtml($subCategory->name); ?>" src="<?php echo $subCategory->image; ?>" />
						</a>
						<?php endif; ?>
	
						<?php if($this->params->get('subCatTitle')): ?>
						<!-- Subcategory title -->
						<h3 class="at-news-k2-category-title">
							<a href="<?php echo $subCategory->link; ?>"><?php echo $subCategory->name; ?></a>
						</h3>
						<?php endif; ?>
	
						<?php if($this->params->get('subCatDescription')): ?>
						<!-- Subcategory description -->
						<p><?php echo $subCategory->description; ?></p>
						<?php endif; ?>
	
						<div class="clr"></div>
					</div>
				</div>
				<?php if(($key+1)%($this->params->get('subCatColumns'))==0): ?>
				<div class="clr"></div>
				<?php endif; ?>
				<?php endforeach; ?>
	
				<div class="clr"></div>
			</div>
			<?php endif; ?>
	
		</div>
		<?php endif; ?>
	
	
	
		<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
		<!-- Item list -->
		<div class="itemList">
	
			<?php if(isset($this->leading) && count($this->leading)): ?>
			<?php
			$leadingcount=(count($this->leading));
			$counter=0;
			?>
			<!-- Leading items -->
			<div id="itemListLeading">
				<?php foreach($this->leading as $key=>$item): ?>	
				<?php
				$key= ($key)+1;
				$rowcount=( ((int)$key-1) %	(int) $this->params->get('num_leading_columns')) +1;
				$row = $counter / $this->params->get('num_leading_columns') ;
		
				if ($rowcount==1) : ?>
				<div class="items-row cols-<?php echo (int) $this->params->get('num_leading_columns');?> <?php echo 'row-'.$row ; ?> row-fluid">
				<?php endif; ?>
					<div class="span<?php echo round((12 / $this->params->get('num_leading_columns')));?>">
						<div class="at-item-leading column-<?php echo $rowcount;?> ">
							<?php
								// Load category_item.php by default
								$this->item=$item;
								echo $this->loadTemplate('item');
							?>
						</div>
						<?php $counter++; ?>
					</div>
				<?php if (($rowcount == $this->params->get('num_leading_columns')) || ($counter ==$primarycount)): ?>
				<span class="row-separator"></span>
				</div>
				<?php endif; ?>
				<?php endforeach; ?>
				<div class="clr"></div>
			</div>
			<?php endif; ?>
	
			<?php if(isset($this->primary) && count($this->primary)): ?>
			<?php
				$primarycount=(count($this->primary));
				$counter=0;
			?>
			<!-- Primary items -->
			<div id="itemListPrimary">
				<?php foreach($this->primary as $key=>$item): ?>
				<?php
					$key= ($key)+1;
					$rowcount=( ((int)$key-1) %	(int) $this->params->get('num_primary_columns')) +1;
					$row = $counter / $this->params->get('num_primary_columns') ;
			
					if ($rowcount==1) : ?>
					<div class="items-row cols-<?php echo (int) $this->params->get('num_primary_columns');?> <?php echo 'row-'.$row ; ?> row-fluid">
					<?php endif; ?>
						<div class="span<?php echo round((12 / $this->params->get('num_primary_columns')));?>">
							<div class="at-item-intro-wrap">
								<div class="at-item-intro column-<?php echo $rowcount;?> ">
									<?php
										// Load category_item.php by default
										$this->item=$item;
										echo $this->loadTemplate('item');
									?>
								</div>
							</div>
						<?php $counter++; ?>
						</div>
					<?php if (($rowcount == $this->params->get('num_primary_columns')) || ($counter ==$primarycount)): ?>
						<span class="row-separator"></span>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				<div class="clr"></div>
			</div>
			<?php endif; ?>
	
			<?php if(isset($this->secondary) && count($this->secondary)): ?>
			<!-- Secondary items -->
			<div id="itemListSecondary">
				<?php foreach($this->secondary as $key=>$item): ?>
				<?php
					$key= ($key)+1;
					$rowcount=( ((int)$key-1) %	(int) $this->params->get('num_secondary_columns')) +1;
					$row = $counter / $this->params->get('num_secondary_columns') ;
			
					if ($rowcount==1) : ?>
					<div class="items-row cols-<?php echo (int) $this->params->get('num_secondary_columns');?> <?php echo 'row-'.$row ; ?> row-fluid">
					<?php endif; ?>
						<div class="span<?php echo round((12 / $this->params->get('num_secondary_columns')));?>">
							<div class="at-item-intro-wrap">
								<div class="at-item-intro column-<?php echo $rowcount;?> ">
									<?php
										// Load category_item.php by default
										$this->item=$item;
										echo $this->loadTemplate('item');
									?>
								</div>
							</div>
						<?php $counter++; ?>
						</div>
					<?php if (($rowcount == $this->params->get('num_secondary_columns')) || ($counter ==$primarycount)): ?>
						<span class="row-separator"></span>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				<div class="clr"></div>
			</div>
			<?php endif; ?>
	
			<?php if(isset($this->links) && count($this->links)): ?>
			<!-- Link items -->
			<div id="itemListLinks" class="at-itemListLinks">
				<h4><?php echo JText::_('K2_MORE'); ?></h4>
				<?php foreach($this->links as $key=>$item): ?>
	
				<?php
				// Define a CSS class for the last container on each row
				if( (($key+1)%($this->params->get('num_links_columns'))==0) || count($this->links)<$this->params->get('num_links_columns') )
					$lastContainer= ' itemContainerLast';
				else
					$lastContainer='';
				?>
	
				<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->links)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_links_columns'), 1).'%;"'; ?>>
					<?php
						// Load category_item_links.php by default
						$this->item=$item;
						echo $this->loadTemplate('item_links');
					?>
				</div>
				<?php if(($key+1)%($this->params->get('num_links_columns'))==0): ?>
				<div class="clr"></div>
				<?php endif; ?>
				<?php endforeach; ?>
				<div class="clr"></div>
			</div>
			<?php endif; ?>
	
		</div>
	
		<!-- Pagination -->
		<?php if($this->pagination->getPagesLinks()): ?>
		<div class="k2Pagination at-pagination">
			<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
			<div class="clr"></div>
			<?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
		</div>
		<?php endif; ?>
	
		<?php endif; ?>
	</div>
</div>
<!-- End K2 Category Layout -->
