<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */

/**
 * Administration panel for UI date/time picker
 *
 * @package ui_datetime
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }
//require_once cot_incfile('ui_datetime', 'plug');

$plug_name = 'ui_datetime';

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('plug', $plug_name);
cot_block($usr['isadmin']);

$adminhelp = $adminhelp1;

require_once cot_incfile('forms');

function cot_selectbox_time($utime, $name = '', $usertimezone = true, $custom_rc = '')
{
	global $L, $R, $usr;
	$rc_name = preg_match('#^(\w+)\[(.*?)\]$#', $name, $mt) ? $mt[1] : $name;

	$utime = ($usertimezone && $utime > 0) ? ($utime + $usr['timezone'] * 3600) : $utime;

	if ($utime == 0)
	{
		list($s_hour, $s_minute) = array(null, null);
	}
	else
	{
		list($s_hour, $s_minute) = explode('-', @date('H-i', $utime));
	}

	$range = array();
	for ($i = 0; $i < 24; $i++)
	{
		$range[] = sprintf('%02d', $i);
	}
	$hour = cot_selectbox($s_hour, $name.'[hour]', $range);

	$range = array();
	for ($i = 0; $i < 60; $i++)
	{
		$range[] = sprintf('%02d', $i);
	}

	$minute = cot_selectbox($s_minute, $name.'[minute]', $range);

	$rc = empty($R["input_date_{$mode}"]) ? 'input_date' : "input_date_{$mode}";
	$rc = empty($R["input_date_{$rc_name}"]) ? $rc : "input_date_{$rc_name}";
	$rc = empty($custom_rc) ? $rc : $custom_rc;

	$result = cot_rc($rc, array(
					'hour' => $hour,
					'minute' => $minute
	));

	return $result;
}



$tt = new XTemplate(cot_tplfile($plug_name.'.tools', 'plug'));
$std_date = cot_selectbox_date(time(),'short','testdate');
$std_time = cot_selectbox_date(time(),'time','testtime');

$tt->parse();
$plugin_body .= $tt->text();

// addition code goes here....

?>