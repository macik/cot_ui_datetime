<?php
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

			// used header cot_rc_add_file functions instead footer versions for Cotonti prior v.9.8
			// due to missed {FOOTER_RC} tag in Admin template
			// if version of Cotonti <= 0.9.8
			$rc_link_func = (version_compare($cfg['version'], '0.9.8') <= 0 || ($cfg['headrc_consolidate'] && $cache)) ? 'cot_rc_add_file' : 'cot_rc_link_footer';
			/* Note from Alex300:
			 * Хук 'rc' срабатывает внутри функции cot_rc_consolidate() которая вызывается если кеш пуст.
			* Если кеш не пуст то она никогда не вызовится и все что в плагине с хуком 'rc' выполнено не будет
			* */

			$rc_link_func($uidt_cfg['jquery_ui_js']);
			cot_rc_add_file($uidt_cfg['jquery_ui_css']);
			if ($usr['lang'] != 'en') {
				if ($uidt_cfg['enable_datepicker']) {
					$lang_file_path = pathinfo($uidt_cfg['jquery_ui_js'],PATHINFO_DIRNAME);
					$lang_file = $lang_file_path."/i18n/jquery.ui.datepicker-{$usr['lang']}.js";
					if (!file_exists($lang_file)) {
						$lang_file = './js/jquery_ui/i18n/jquery.ui.datepicker-'.$usr['lang'].'.js';
					}
					$rc_link_func($lang_file);
				}
			}
			$rc_link_func($cfg['plugins_dir']."/$plug_name/js/$plug_name.js");

			if ($uidt_cfg['enable_timepicker']) {
				$timepicker_path = pathinfo($uidt_cfg['timepicker_js'],PATHINFO_DIRNAME);
				cot_rc_add_file($uidt_cfg['timepicker_css'],'global',70);
				$rc_link_func ($uidt_cfg['timepicker_js']);
				if ($usr['lang'] != 'en') {
					$lang_file = $timepicker_path . "/i18n/jquery-ui-timepicker-{$usr['lang']}.js";
					$rc_link_func($lang_file);
				}
				if ($uidt_cfg['support_touch']) {
					$rc_link_func($timepicker_path . "/jquery-ui-sliderAccess.min.js");
				}
			}
	}
}
