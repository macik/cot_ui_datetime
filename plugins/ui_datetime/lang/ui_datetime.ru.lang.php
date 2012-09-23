<?PHP
/**
 * Localization file for UI date/time picker
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

$L['plu_title'] = 'Замена стандартного меню выбора дат и времени'; // для заголовка страницы
$L['uidt_jqueryrequired'] = 'Этот плагин работает только при включенной библиотеке jQuery.';
$L['uidt_testpage'] = 'Тестовая страница для элементов выбора даты/времени';
$L['uidt_Date'] = 'Тестовый элемент выбора даты';
$L['uidt_Time'] = 'Тестовый элемент выбора времени';
$L['uidt_oldstyle'] = 'Обычный для Cotonti элемент выбора';
$L['uidt_newstyle'] = 'Новый UI элемент (используемый в плагине)';
$L['uidt_switchedoff'] = 'Элемент управления выключен';

$L['cfg_global_mode'] = array('Включить `global` режим','Когда `global` режим включен расширение загружается на всех страницах сайта
				и обрабатывает все стандартные элементы дата/время. <br />
				Когда режим `global` выключен (по умолчанию) расширение загружается только при добавлении/редактировании страниц и при редактировании профиля пользователей.');
$L['cfg_jquery_ui_js'] = array('Полный путь к JS библиотеке jQuery UI','изменяйте только в том случае, когда вы перенесли файлы в другой каталог или используете другой файл библиотеки.');
$L['cfg_jquery_ui_css'] = array('Полный путь к CSS файлу jQuery UI','');
$L['cfg_enable_datepicker'] = array('Включить `новый` элемент выбора даты','Если выключить на страницах будет стандартный элемент.');
$L['cfg_enable_timepicker'] = array('Включить `новый` элемент выбора времени','Если выключить на страницах будет стандартный элемент.');
$L['cfg_timepicker_js'] = array('Полный путь к jQuery плагину TimePickr','');
$L['cfg_timepicker_css'] = array('Полный путь к файлу CSS для TimePickr','');



$adminhelp1 = '
<p>В таблице показаны стандартные для Cotonti элементы выбора даты/времени (в первой колонке) и
новые элементы (во второй колонке), которые будут использоваться в Cotonti, когда установлено расширение <strong>ui_datetime</strong>.</p>
<p>Новый и старый элементы выбора даты/времени синхронизированы между собой, вы можете протестировать их.</p><br />
<p>Вы можете использовать следующие сочетания клавиш для управления элементом выбора даты: <br />
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

$adminhelp2 = 'Этот плагин предназначен для замены стандартных элементов выбора даты и времени. <br />
Вместо нескольких выпадающих меню будут отображаться единые поля ввода даты и времени с удобным
всплывающим диалогом выбора.';

?>