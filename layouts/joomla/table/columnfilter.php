<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

/** @var Table $table */
$columns = $displayData['columns'];
$id = $displayData['id'];
$name = $displayData['name'];

?>
<div class="dropdown pull-right">
	<a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="fa fa-filter" title="Filter"></span>
	</a>
	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
		<form class="px-4 py-3">
			<div class="form-group">
				<?php foreach ($columns as $column) : ?>
				<?php if (!isset($column['title'])) continue; ?>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="dropdownCheck" checked <?php echo isset($column['protected']) ? 'disabled' : ''; ?>>
					<label class="form-check-label" for="dropdownCheck">
						<?php echo $column['title']; ?>
					</label>
				</div>
				<?php endforeach; ?>
			</div>
		</form>
	</div>
</div>
