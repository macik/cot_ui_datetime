<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=rc
[END_COT_EXT]
==================== */

/**
 * Header file for UI date/time picker plugin
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }

$plug_name = 'ui_datetime';
global $uidt_cfg;
$uidt_cfg = $cfg['plugin'][$plug_name];

if ($cfg['jquery'] && ($uidt_cfg['enable_datepicker'] || $uidt_cfg['enable_timepicker'])){
	if ($uidt_cfg['global_mode']
		|| ( $_GET['e'] == $plug_name
			|| ( $_GET['e'] == 'page' && ($_GET['m'] == 'edit' || $_GET['m'] == 'add' ))
			|| ( $_GET['e'] == 'users' && ($_GET['m'] == 'edit' || $_GET['m'] == 'profile' ))
			|| ( $_GET['m'] == 'other' && $_GET['p'] == $plug_name )
		)) {

			define('UI_DATETIME',true);

			// used header cot_rc functions instead footer versions for Cotonti prior v.9.8
			// due to missed {FOOTER_RC} tag
			$version = str_replace('.','',$cfg['version']);
			$rc_link_func = ($version<98) ? 'cot_rc_add_file' : 'cot_rc_link_footer';

			$r_date = $R['input_date_short'];
			$r_time = str_replace($r_date, '', $R['input_date']);

			$attr = ($_GET['m'] == 'other' && $_GET['p']) ? 'data-uidt-prefix="target" data-uidt-showformat="1"' : 'style="display:none;"';

			if ($uidt_cfg['enable_datepicker']) {
				$r_date = "<div class=\"uidt_date\" $attr>".$r_date.'</div><div style="display:inline;" class="uidt_datetarget"></div>';
			}
			if ($uidt_cfg['enable_timepicker']) {
				$r_time = "<div class=\"uidt_time\" $attr>".$r_time.'</div><div style="display:inline;" class="uidt_timetarget"></div>';
			}

			$R['input_date'] = $r_date.$r_time; // new template for datetime
			$R['input_date_short'] = $r_date; // new template for time
			$R['input_date_time'] = $r_time; // new template for datetime

			$rc_link_func ($uidt_cfg['jquery_ui_js']);
			cot_rc_add_file($uidt_cfg['jquery_ui_css']);
			if ($usr['lang'] != 'en' && $uidt_cfg['enable_datepicker']) {
				$lang_file = pathinfo($uidt_cfg['jquery_ui_js'],PATHINFO_DIRNAME)
					 		. "/i18n/jquery.ui.datepicker-{$usr['lang']}.js";
				$rc_link_func ($lang_file);
			}
			$rc_link_func ($cfg['plugins_dir']."/$plug_name/js/$plug_name.js");

			if ($uidt_cfg['enable_timepicker']) {
				cot_rc_add_file($uidt_cfg['timepicker_css'],'global',70);
				$rc_link_func ($uidt_cfg['timepicker_js']);
			}
	}
}

?>