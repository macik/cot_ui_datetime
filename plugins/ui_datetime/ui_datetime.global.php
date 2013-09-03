<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=global
[END_COT_EXT]
==================== */

/**
 * Global hook file for UI date/time picker plugin
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }

$plug_name = 'ui_datetime';
//global $uidt_cfg;
$uidt_cfg = $cfg['plugin'][$plug_name];

if ($cfg['jquery'] && ($uidt_cfg['enable_datepicker'] || $uidt_cfg['enable_timepicker'])){
	if ($uidt_cfg['global_mode']
		|| ( $_GET['e'] == $plug_name
			|| ( $_GET['e'] == 'page' && ($_GET['m'] == 'edit' || $_GET['m'] == 'add' ))
			|| ( $_GET['e'] == 'users' && ($_GET['m'] == 'edit' || $_GET['m'] == 'profile' ))
			|| ( $_GET['m'] == 'other' && $_GET['p'] == $plug_name )
			|| ( $_GET['e'] == 'search' )
		)) {
			define('UI_DATETIME',true);

			$r_date = $R['input_date_short'];
			$r_time = str_replace($r_date, '', $R['input_date']);

			$attr = ($_GET['m'] == 'other' && $_GET['p']) ? 'data-target="target" data-dateformat="1" data-show="source"' : '';

			if ($uidt_cfg['hidden_source']){
				$attr .= ' style="display:none;"';
			}
			if ($uidt_cfg['support_touch']){
				$attr .= '  data-touch="true"';
			}

			if ($uidt_cfg['enable_datepicker']) {
				$r_date = "<div class=\"common_date\" $attr>".$r_date.'</div><div style="display:inline;" class="date_target"></div>';
			}
			if ($uidt_cfg['enable_timepicker']) {
				$r_time = "<div class=\"common_time\" $attr>".$r_time.'</div><div style="display:inline;" class="time_target"></div>';
			}

			$R['input_date'] = '<div class="uidt mode-datetime">'.$r_date.$r_time.'</div>'; // new template for datetime
			$R['input_date'] = str_replace('data-target="target"', 'data-target="targetall"', $R['input_date']);
			$R['input_date'] = str_replace('data-dateformat="1"', '', $R['input_date']);
			$R['input_date_short'] = '<div class="uidt mode-date">'.$r_date.'</div>'; // new template for date
			$R['input_date_time'] = '<div class="uidt mode-time">'.$r_time.'</div>'; // new template for time
			$R['input_date_combined'] = str_replace('data-target="targetall"', 'data-target="targetallcmb"', $R['input_date']);
			$R['input_date_combined'] = str_replace('mode-datetime', 'mode-datetime-combined', $R['input_date_combined']);
	}
}

