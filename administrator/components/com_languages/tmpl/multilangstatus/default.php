<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_languages
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$notice_homes     = $this->homes == 2 || $this->homes == 1 || $this->homes - 1 != count($this->contentlangs) && ($this->language_filter || $this->switchers != 0);
$notice_disabled  = !$this->language_filter	&& ($this->homes > 1 || $this->switchers != 0);
$notice_switchers = !$this->switchers && ($this->homes > 1 || $this->language_filter);
?>
<div class="mod-multilangstatus">
	<?php if (!$this->language_filter && $this->switchers == 0) : ?>
		<?php if ($this->homes == 1) : ?>
			<div class="alert alert-info">
				<span class="fa fa-info-circle" aria-hidden="true"></span>
				<span class="sr-only"><?php echo Text::_('INFO'); ?></span>
				<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_NONE'); ?>
			</div>
		<?php else : ?>
			<div class="alert alert-info">
				<span class="fa fa-info-circle" aria-hidden="true"></span>
				<span class="sr-only"><?php echo Text::_('INFO'); ?></span>
				<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_USELESS_HOMES'); ?>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<?php if ($this->defaultHome == true) : ?>
			<div class="alert alert-warning">
				<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
				<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
				<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_DEFAULT_HOME_MODULE_PUBLISHED'); ?>
			</div>
		<?php endif; ?>
		<?php if ($notice_homes) : ?>
			<div class="alert alert-warning">
				<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
				<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
				<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_HOMES_MISSING'); ?>
			</div>
		<?php endif; ?>	
		<?php if ($notice_disabled) : ?>
			<div class="alert alert-warning">
				<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
				<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
				<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_LANGUAGEFILTER_DISABLED'); ?>
			</div>
		<?php endif; ?>
		<?php if ($notice_switchers) : ?>
			<div class="alert alert-warning">
				<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
				<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
				<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_LANGSWITCHER_UNPUBLISHED'); ?>
			</div>
		<?php endif; ?>
		<?php foreach ($this->contentlangs as $contentlang) : ?>
			<?php if (array_key_exists($contentlang->lang_code, $this->homepages) && (!array_key_exists($contentlang->lang_code, $this->site_langs) || !$contentlang->published)) : ?>
				<div class="alert alert-warning">
					<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
					<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
					<?php echo Text::sprintf('COM_LANGUAGES_MULTILANGSTATUS_ERROR_CONTENT_LANGUAGE', $contentlang->lang_code); ?>
				</div>
			<?php endif; ?>
			<?php if (!array_key_exists($contentlang->lang_code, $this->site_langs)) : ?>
				<div class="alert alert-warning">
					<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
					<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
					<?php echo Text::sprintf('COM_LANGUAGES_MULTILANGSTATUS_ERROR_LANGUAGE_TAG', $contentlang->lang_code); ?>
				</div>
			<?php endif; ?>
			<?php if ($contentlang->published == -2) : ?>
				<div class="alert alert-warning">
					<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
					<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
					<?php echo Text::sprintf('COM_LANGUAGES_MULTILANGSTATUS_ERROR_CONTENT_LANGUAGE_TRASHED', $contentlang->lang_code); ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php if ($this->listUsersError) : ?>
			<div class="alert alert-info">
				<span class="fa fa-help" aria-hidden="true"></span>
				<span class="sr-only"><?php echo Text::_('JHELP'); ?></span>
				<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_CONTACTS_ERROR_TIP'); ?>
				<ul>
				<?php foreach ($this->listUsersError as $user) : ?>
					<li>
					<?php echo Text::sprintf('COM_LANGUAGES_MULTILANGSTATUS_CONTACTS_ERROR', $user->name); ?>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		<table class="table table-sm">
			<thead>
				<tr>
					<th>
						<?php echo Text::_('JDETAILS'); ?>
					</th>
					<th class="text-center">
						<?php echo Text::_('JSTATUS'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">
						<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_LANGUAGEFILTER'); ?>
					</th>
					<td class="text-center">
						<?php if ($this->language_filter) : ?>
							<?php echo Text::_('JENABLED'); ?>
						<?php else : ?>
							<?php echo Text::_('JDISABLED'); ?>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_LANGSWITCHER_PUBLISHED'); ?>
					</th>
					<td class="text-center">
						<?php if ($this->switchers != 0) : ?>
							<?php echo $this->switchers; ?>
						<?php else : ?>
							<?php echo Text::_('JNONE'); ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<?php if ($this->homes > 1) : ?>
							<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_HOMES_PUBLISHED_INCLUDING_ALL'); ?>
						<?php else : ?>
							<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_HOMES_PUBLISHED'); ?>
						<?php endif; ?>
					</th>
					<td class="text-center">
						<?php if ($this->homes > 1) : ?>
							<?php echo $this->homes; ?>
						<?php else : ?>
							<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_HOMES_PUBLISHED_ALL'); ?>
						<?php endif; ?>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-sm">
			<thead>
				<tr>
					<th>
						<?php echo Text::_('JGRID_HEADING_LANGUAGE'); ?>
					</th>
					<th class="text-center">
						<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_SITE_LANG_PUBLISHED'); ?>
					</th>
					<th class="text-center">
						<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_CONTENT_LANGUAGE_PUBLISHED'); ?>
					</th>
					<th class="text-center">
						<?php echo Text::_('COM_LANGUAGES_MULTILANGSTATUS_HOMES_PUBLISHED'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->statuses as $status) : ?>
					<?php if ($status->element) : ?>
						<tr>
							<td>
								<?php echo $status->element; ?>
							</td>
					<?php endif; ?>
					<?php // Published Site languages ?>
					<?php if ($status->element) : ?>
							<td class="text-center">
								<span class="fa fa-check" aria-hidden="true"></span>
								<span class="sr-only"><?php echo Text::_('JYES'); ?></span>
							</td>
					<?php else : ?>
							<td class="text-center">
								<?php echo Text::_('JNO'); ?>
							</td>
					<?php endif; ?>
					<?php // Published Content languages ?>
					<?php if ($status->lang_code && $status->published == 1) : ?>
							<td class="text-center">
								<span class="fa fa-check" aria-hidden="true"></span>
								<span class="sr-only"><?php echo Text::_('JYES'); ?></span>
							</td>
					<?php elseif ($status->lang_code && $status->published == 0) : ?>
						<td class="text-center">
							<span class="icon-pending" aria-hidden="true"></span>
							<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
						</td>
					<?php elseif ($status->lang_code && $status->published == -2) : ?>
						<td class="text-center">
							<span class="icon-trash" aria-hidden="true"></span>
							<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
						</td>
					<?php else : ?>
							<td class="text-center">
								<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
								<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
							</td>
					<?php endif; ?>
					<?php // Published Home pages ?>
					<?php if ($status->home_language) : ?>
							<td class="text-center">
								<span class="fa fa-check" aria-hidden="true"></span>
								<span class="sr-only"><?php echo Text::_('JYES'); ?></span>
							</td>
					<?php else : ?>
							<td class="text-center">
								<span class="fa fa-times" aria-hidden="true"></span>
								<span class="sr-only"><?php echo Text::_('JNO'); ?></span>
							</td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				<?php foreach ($this->contentlangs as $contentlang) : ?>
					<?php if (!array_key_exists($contentlang->lang_code, $this->site_langs)) : ?>
						<tr>
							<td>
								<?php echo $contentlang->lang_code; ?>
							</td>
							<td class="text-center">
								<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
								<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
							</td>
							<td class="text-center">
								<?php if ($contentlang->published) : ?>
									<span class="fa fa-check" aria-hidden="true"></span>
									<span class="sr-only"><?php echo Text::_('JYES'); ?></span>
								<?php elseif (!$contentlang->published && array_key_exists($contentlang->lang_code, $this->homepages)) : ?>
									<span class="fa fa-times" aria-hidden="true"></span>
									<span class="sr-only"><?php echo Text::_('JNO'); ?></span>
								<?php elseif (!$contentlang->published) : ?>
									<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
									<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
								<?php endif; ?>
							</td>
							<td class="text-center">
								<?php if (!array_key_exists($contentlang->lang_code, $this->homepages)) : ?>
									<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
									<span class="sr-only"><?php echo Text::_('WARNING'); ?></span>
								<?php else : ?>
									<span class="fa fa-check" aria-hidden="true"></span>
									<span class="sr-only"><?php echo Text::_('JYES'); ?></span>
								<?php endif; ?>
							</td>
						</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</div>
