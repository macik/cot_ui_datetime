<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.extrafields.add
[END_COT_EXT]
==================== */

/**
 * Helper for adding datetime extrafields with UI_datetime format
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

defined('COT_CODE') || die('Wrong URL ');

if (defined('UI_DATETIME')) {
	if (!$field['field_html']) {
		$field['field_html'] = $R['input_date'];
	}
}