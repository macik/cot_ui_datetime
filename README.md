UI_datetime 
===========

Plugin for Cotonti CMF. It replaces common date/time selection controls with
unified pretty style jQueryUI controls.

Description
-----------

Current date/time selection controls are presented as several separated dropdown select box.
Separate for year, month, day for date and hour, minutes for time.
The plugin hides this controls and bring to user unified one input field for date
and one field for time respectively. In addition this fields supplied with
easy-to-use dropdown UI controls to selec date/time in one-click.

Features
--------

The following markups are supported.  The dependencies listed are required if
you wish to run the library.

* Unified input field for date selections
* Unified input field for time selections
* User friendly pop-up UI control attached for fast selection of date time
* I18n for datepicker control (date format, month and day of weeks names)
* Using jQueryUI library
* jQueryUI ThemeRoller ready
* By default working in add/edit page, edit users, user profile.
* Optional mode to track any date/time controls and replace with new one regardless opened page 
or extension

Demo page
---------

You can see demonstration how extension works here: [Demo page on GitHub](http://macik.github.com/cot_ui_datetime/demo.html)

### Comments

Plugin must works out from the box. Tested on `Nemesis`, `HTML Kickstart`, `SymiSun-03` 
theme and must work on most common themes or extension that uses standard date/time controls 
that relies on `cot_selectbox_date` function and `$R['input_date*']` resource strings.

But if your use highly customized theme or your custom resource strings (`$R['input_date*']`) than
extension may work uncorrectly.


### How extension works

Old style controls simply hides with inline styles but still work as input fields for transfer 
parameters to server (while you save the data).
New fancy style UI controls use jQuery UI library and dynamically added in pages in specially 
marked DIV containers. 

Simply it maked by changing controls template in resource strings `$R['input_date']` 
and `$R['input_date_short']`.

The default __ui_date/time__ template for _'short'_ date is:

    <div class="uidt_date">{$day} {$month} {$year}</div>
    <div class="uidt_datetarget"></div> 

(See `ui_datetime.rc.php` for details.)

Most part of magic happened after page loads. JS script searches for elements 
with `uidt_date` and `uidt_time` class then 
parse it and linked with new controls added in elements with `uidt_datetarget` 
and `uidt_timetarget` class respectively. 
                
By default extension tracks controls only on these pages: add/edit page, edit users, user profile.
You can switch on `global mode` in settings for trace all controls on all pages, but it's not
recommened because will load extension files all the time.


Install
-------

* Unpack, copy files to root folder of your site.
* Install via Admin → Extensions menu (`Administration panel → Extensions`)
* If you already use jQueryUI in your project than setup path for jQueryUI library 
in ui_datetime [settings](www.example.com/admin/config?n=edit&o=plug&p=ui_datetime) .

### Comments

After install you can see and test extension on Admin → Tools page
(`Administration panel → Extensions → UI date/time picker → Administration`).
You can Enable/Disable date and time controls separately via settings.


References
----------

* [Cotonti.com](http://Cotonti.com/) -- Home of Cotonti CMF
* [Discussion](http://www.cotonti.com/forums/?m=posts&q=7105) -- Forum thread about extension (in russian)

