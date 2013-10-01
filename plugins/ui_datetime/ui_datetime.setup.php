<?php
/* ====================
[BEGIN_COT_EXT]
Code=ui_datetime
Name=UI date/time picker
Category=customization-i18n
Description=Replaces common date/time dropdown select boxes with usefull jQuery UI date/time picker
Version=1.6.5-1.8.23
Date=2013-sep-30
Author=Andrey Matsovkin
Copyright=Copyright (c) 2008-2013, Andrey Matsovkin
Notes=Tested with Siena 0.9.14
Auth_guests=
Lock_guests=W2345A
Auth_members=RW1
Lock_members=2345
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
global_mode=01:radio:0,1:0:Enable `global mode`
jquery_ui_js=02:string::./js/jquery_ui/jquery-ui-1.8.23.full.min.js:Full path to jQuery UI library
jquery_ui_css=04:string::./js/jquery_ui/css/redmond/jquery-ui-1.8.23.full.css:Full path to jQuery UI css file
support_touch=05:radio:0,1:1:Enabled support slider on touch devices
enable_datepicker=07:radio:0,1:1:Enable datepicker
enable_timepicker=11:radio:0,1:1:Enable timepicker
timepicker_js=12:string::./js/time_picker/jquery-ui-timepicker-addon.min.js:Full path to jQuery TimePicker library
timepicker_css=14:string::./js/time_picker/css/jquery-ui-timepicker-addon.min.css:Full path to TimePicker css file
hidden_source=17:radio:0,1:1:Hide source with style attribute
combined=19:radio:0,1:0:Enable `combined` mode by default
[END_COT_EXT_CONFIG]
==================== */

/**
 * UI date/time picker plugin for Cotonti CMF
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
*/

if (!defined('COT_CODE')) { die('Wrong URL '); }

