/**
 * Parses name of input elements and return its base name
 * (actual for arrays)
 * Examples:
 * 		param[value] -> param
 * 		param[value][value2] -> param[value]
 * @param input element name
 * @returns string
 */
function getInputName(name){
	var splited = name.split('[');
	if (splited.length > 1) {
		splited.pop();
		return splited.join('[');
	} else {
		return splited[0];
	}
}

/**
 * Parse string in HH:MM or HH-MM format and if time string is valid
 * return array of hours and minutes with leading zeroes.
 * If string is invalid or values exceed time format returns NULL
 * If empty string passed returns it.
 * @param time_str
 * @returns array || null || ''
 */
function parse_time(time_str) {
	if (time_str == '' ) return '';
	if (typeof time_str !== "string") return null;
	re = /\s*(\d+)[\s\.:-](\d{1,2})\s*/;
	timeArr = time_str.match(re);
	if (timeArr)
		if (timeArr[1] && timeArr[2] && timeArr[1] >= 0 && timeArr[1] <= 23
				&& timeArr[2] >= 0 && timeArr[2] <= 59) {
			timeArr[1] = ('0' + timeArr[1]).slice(-2);
			timeArr[2] = ('0' + timeArr[2]).slice(-2);
			timeArr['hour'] = timeArr[1];
			timeArr['minute'] = timeArr[2];
			return timeArr;
		} else return null;
}

/**
 * Checks element for date/time controls, hides standard ones
 * adds new style picker and link its data with hidden inputs.
 * @param dt_block - jQuery object for datetime block element
 */
function enable_datetime_picker($dt_block){
	var classes = $dt_block.attr('class').split(' '),
		mode = 0;
		valDay, valMonth, valYear, valHour, valMinute;
	if (classes.indexOf('mode-date')>-1) mode = 1;
	if (classes.indexOf('mode-time')>-1) mode = 2;
	if (classes.indexOf('mode-datetime')>-1) mode = 3;
	if (classes.indexOf('mode-datetime-combined')>-1) mode = 4;
	if (!mode) return;
	if (mode != 2) { // for all date modes
		var date_control = $dt_block.find("div.common_date"),
			elDay = date_control.find('select').filter("[name*='day']"),
			elMonth = date_control.find('select').filter("[name*='month']"),
			elYear = date_control.find('select').filter("[name*='year']");
		if (date_control.data('show') == 'off') {
			date_control.show();
			return;
		}
		if (elDay.length && elMonth.length && elYear.length) {
			var
				date_target = date_control.data('target'),
				name_for_date= getInputName(date_control.find('select').prop('name')).replace(/[^\w+]/g,''),
				date_input_id = 'rdpick_'+name_for_date,
				date_class_name = '.'+date_target+'_'+name_for_date,
				date_input = $('<input>').attr('id',date_input_id).attr('type','text'); // input id="rdpick_'+name_for_date+'" type="text">';

			if (date_target && $(date_class_name).length) {
				var $date_target = $(date_class_name);
			} else {
				var $date_target = $dt_block.find('.date_target');
			}
			$date_target.append(date_input);
			var $datepicker = $('#'+date_input_id);
			(date_control.data('show') == 'source') ? date_control.show() : date_control.hide();
			var valDay   = elDay.val();
			var valMonth = elMonth.val();
			var valYear  = elYear.val();
			var minYear = 9999;
			var maxYear = 1000;
			elYear.find("option").each(function(i,e){
				val = $(e).prop('value');
				if (val) {
					if (val < minYear) minYear = val;
					if (val > maxYear) maxYear = val;
				}
			});
			var maxDate = new Date(maxYear,11,31),
				minDate = new Date(minYear,0,1);
		}


	}
	if (mode!=1) { // for all modes with timepicker
		var time_control = $dt_block.find("div.common_time"),
			elHour = time_control.find('select').filter("[name*='hour']"),
			elMinute = time_control.find('select').filter("[name*='minute']");
		if (time_control.data('show') == 'off') {
			time_control.show();
			return;
		}
		if (elHour.length && elMinute.length) {
			var time_target = time_control.data('target'),
				name_for_time = getInputName(time_control.find('select').prop('name')).replace(/[^\w+]/g,''),
				time_input_id = 'rtpick_' + name_for_time,
				time_class_name = '.' + time_target + '_' + name_for_time,
				time_input = $('<input>').attr('id',time_input_id).attr('type','text');
			if (time_target && $(time_class_name).length) {
				var $time_target = $(time_class_name);
			} else {
				var $time_target = $dt_block.find('.time_target');
			}
			if (mode!=4) $time_target.append(time_input);
			var $timepicker = $('#'+time_input_id);
			(time_control.data('show') == 'source') ? time_control.show() : time_control.hide();

			var valHour = elHour.val();
			var valMinute = elMinute.val();
			if (valHour && valMinute) {
				var timeStr = valHour + ':' + valMinute;
			} else {
				var timeStr = '';
			}
		}
	}
	if (valDay && valMonth && valYear) {
		var dateObj = new Date(valYear,valMonth-1,valDay,valHour,valMinute);
	} else {
		var dateObj = '';
	}

	// initializing datepicker, timepicker or combined input
	if (mode==4){
			$datepicker.datetimepicker({
				//altField: '#'+time_input_id,
				//showButtonPanel: false,
				changeYear: true,
				maxDate: maxDate,
				minDate: minDate,
				yearRange: minYear + ':' + maxYear,
				onClose: function(dateText, inst) {
					if (!dateText) {
						$(date_control).val('');
						elYear.val('');
						elMonth.val('');
						elDay.val('');
					} else {
						curDate = $(this).datetimepicker('getDate');
						newDay   = curDate.getDate();
						newMonth = curDate.getMonth()+1;
						newYear  = curDate.getFullYear();
						timeStr = $datepicker.val().split(' ')[1];
						var newtime = parse_time(timeStr);
						yearExists  = elYear.find('option[value='+newYear+']').length;
						monthExists = elMonth.find('option[value='+newMonth+']').length;
						dayExists   = elDay.find('option[value='+newDay+']').length;
						if (monthExists && dayExists && yearExists) {
							elYear.val(newYear);
							elMonth.val(newMonth);
							elDay.val(newDay);
							if (newtime && newtime.length == 3) {
								elHour.val(newtime.hour);
								elMinute.val(newtime.minute);
							}
							dateObj = $(this).datetimepicker('getDate');
						} else {
							$(this).datetimepicker('setDate',dateObj);
						}
					}
				},
				defaultDate:dateObj
			}).datetimepicker('setDate',dateObj);
			if (date_control && date_control.data('dateformat')) {
				$datepicker.datepicker("option", "appendText", ' (' + $datepicker.datetimepicker( "option", "dateFormat" )+')');
			}
		}

	if (mode==2 || mode==3) {
		$timepicker.val(timeStr);
		$timepicker.timepicker({
			addSliderAccess: time_control.data('touch'),
			sliderAccessArgs: { touchonly: false },
			onClose: function(dateText, inst) {
				var newtime = parse_time($(this).val());
				if (newtime && newtime.length == 3 ) {
					elHour.val(newtime.hour);
					elMinute.val(newtime.minute);
				} else {
					$(this).val(timeStr);
				}
			}
		});
		$timepicker.change(function(){
			var newtime = parse_time($(this).val());
			if (newtime && newtime.length == 3 ) {
				elHour.val(newtime.hour);
				elMinute.val(newtime.minute);
			} else {
				$(this).val(timeStr);
			}
		});
	}

	if (mode==1 || mode==3) {
		$datepicker.datepicker({
			changeYear: true,
			maxDate: maxDate,
			minDate: minDate,
			yearRange: minYear + ':' + maxYear,
			onClose: function(dateText, inst) {
				if (!dateText) {
					$(date_control).val('');
					elYear.val('');
					elMonth.val('');
					elDay.val('');
				} else {
					curDate = $(this).datepicker('getDate');
					$(this).datepicker('setDate',curDate);
					newDay   = curDate.getDate();
					newMonth = curDate.getMonth()+1;
					newYear  = curDate.getFullYear();
					yearExists  = elYear.find('option[value='+newYear+']').length;
					monthExists = elMonth.find('option[value='+newMonth+']').length;
					dayExists   = elDay.find('option[value='+newDay+']').length;
					if (monthExists && dayExists && yearExists) {
						elYear.val(newYear);
						elMonth.val(newMonth);
						elDay.val(newDay);
						dateObj = $(this).datepicker('getDate');
					} else {
						$(this).datepicker('setDate',dateObj);
					}
				}
			},
			onSelect: function(dateText, inst) {},
			defaultDate:dateObj
		}).datepicker('setDate',dateObj);

	}
}

$(function() {
	$('div[class~=uidt]').each(function(i,e){
		var name = getInputName($(e).find('select').prop('name'));
		enable_datetime_picker($(this));
	});
});