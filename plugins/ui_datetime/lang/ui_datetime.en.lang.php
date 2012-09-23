<?PHP
/**
 * Localization file for UI date/time picker
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

$L['plu_title'] = 'UI date/time picker'; // для заголовка страницы
$L['uidt_jqueryrequired'] = 'This plugin works only with jQuery enabled';
$L['uidt_testpage'] = 'Testing page for date/time picker UI';
$L['uidt_Date'] = 'Test date UI widget';
$L['uidt_Time'] = 'Test time UI widget';
$L['uidt_oldstyle'] = 'Common Cotonti date/time selection controls';
$L['uidt_newstyle'] = 'New date/time UI controls (used with extension)';
$L['uidt_switchedoff'] = 'Controls switched off';

$L['cfg_global_mode'] = array('Enable `global mode`','When `global mode` is on extension
				loads on every page and replaces standard date/time controls. <br />
				When `global mode` is off (recommended) extension load only on add/edit page and user edit/profile.');
$L['cfg_jquery_ui_js'] = array('Full path to jQuery UI library','change only if you move default library or using another one.');
$L['cfg_jquery_ui_css'] = array('Full path to jQuery UI css file','');
$L['cfg_enable_datepicker'] = array('Enable `newstyle` datepicker','If switched off you see standard date selection controls.');
$L['cfg_enable_timepicker'] = array('Enable `newstyle` timepicker','If switched off you see standard time selection controls.');
$L['cfg_timepicker_js'] = array('Full path to jQuery TimePickr library','');
$L['cfg_timepicker_css'] = array('Full path to TimePickr css file','');

$adminhelp1 = '
<p>In this test table you can see Cotonti `old style` elements for date/time selection (in first column) and
`new style` unified elemints that will be used in Cotonti when <strong>ui_datetime</strong> extension installed.</p>
<p>New UI elements are linked with standard ones. You may change values in it to test it.</p><br />
<p>You can use keyboard shortcuts to drive the datepicker: <br />
<ul>
	<li><span class="key">page up/down</span> - <span class="text">previous/next month</span></li>
	<li><span class="key">ctrl+page up/down</span> - <span class="text">previous/next year</span></li>
	<li><span class="key">ctrl+home</span> - <span class="text">current month or open when closed</span></li>
	<li><span class="key">ctrl+left/right</span> - <span class="text">previous/next day</span></li>
	<li><span class="key">ctrl+up/down</span> - <span class="text">previous/next week</span></li>
	<li><span class="key">enter</span> - <span class="text">accept the selected date</span></li>
	<li><span class="key">ctrl+end</span> - <span class="text">close and erase the date</span></li>
	<li><span class="key">escape</span> - <span class="text">close the datepicker without selection</span></li>
</ul>
<p>';

$adminhelp2 = 'This plugin replaces common used date/time selection elements on page with
user friendly controls with attached jQueryUI dialogs.';


?>