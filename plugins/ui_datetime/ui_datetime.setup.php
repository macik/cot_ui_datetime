<?php
/* ====================
[BEGIN_COT_EXT]
Code=ui_datetime
Name=UI date/time picker
Description=Replaces common date/time dropdown select boxes with usefull jQuery UI date/time picker
Version=1.5.1-1.8.23
Date=2012-Dec-03
Author=Andrey Matsovkin
Copyright=Copyright (c) 2008-2012, Andrey Matsovkin
Notes=Tested with Siena 0.9.5 - 0.9.12
Auth_guests=
Lock_guests=W2345A
Auth_members=RW1
Lock_members=2345
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
global_mode=01:radio:0,1:0:Enable `global mode`
jquery_ui_js=02:string::./js/jquery_ui/jquery-ui-1.8.23.full.min.js:Full path to jQuery UI library
jquery_ui_css=04:string::./js/jquery_ui/css/redmond/jquery-ui-1.8.23.full.css:Full path to jQuery UI css file
enable_datepicker=07:radio:0,1:1:Enable datepicker
enable_timepicker=11:radio:0,1:1:Enable timepicker
timepicker_js=12:string::./js/time_pickr/jquery.timepickr.js:Full path to jQuery TimePicker library
timepicker_css=14:string::./js/time_pickr/css/ui.timepickr.css:Full path to TimePicker css file
[END_COT_EXT_CONFIG]
==================== */

/**
 * UI date/time picker plugin for Cotonti CMF
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
*/

if (!defined('COT_CODE')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }


?>