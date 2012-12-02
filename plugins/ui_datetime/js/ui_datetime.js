/**
 * Parse string in HH:MM or HH-MM format and if time string is valid
 * return array of hours and minutes with leading zeroes.
 * If string is invalid or values exceed time format returns NULL
 * If empty string passed returns it.
 * @param time_str
 * @returns array || null || ''
 */
function parse_time(time_str) {
	if (time_str == '') return '';
	re = /\s*(\d+)[\s\.:-](\d{1,2})\s*/;
	timeArr = time_str.match(re);
	if (timeArr)
		if (timeArr[1] && timeArr[2] && timeArr[1] >= 0 && timeArr[1] <= 23
				&& timeArr[2] >= 0 && timeArr[2] <= 59) {
			timeArr[1] = ('0' + timeArr[1]).slice(-2);
			timeArr[2] = ('0' + timeArr[2]).slice(-2);
			return timeArr;
		} else return null;
}

/**
 * Replaces Cotonti standard date selection boxes with unified datepicker
 * @param name - name of Select elements
 * @param targetPrefix - result will be placed in tag with class targetPrefix_name
 */
function replace_std_datepicker(name,targetPrefix){
	var name_for_id = name.replace(/[^\w+]/g,''),
		date_control = $("div.uidt_date > select[name='"+name+"[day]']").parent(),
		elDay = date_control.find('select').filter("[name*='day']"),
		elMonth = date_control.find('select').filter("[name*='month']"),
		elYear = date_control.find('select').filter("[name*='year']");
	if (elDay.length && elMonth.length && elYear.length) {
		var datepicker_template = '<input id="rdpick_'+name_for_id+'" type="text">';
		if (targetPrefix) {
			var target = $('.'+targetPrefix+'_'+name);
		} else {
			var target = elYear.parent().next('.uidt_datetarget');
		}
		target.append(datepicker_template);
		date_control.hide();
		var valDay   = elDay.val();
		var valMonth = elMonth.val();
		var valYear  = elYear.val();
		if (valDay && valMonth && valYear) {
			var dateObj = new Date(valYear,valMonth-1,valDay);
		} else {
			var dateObj = '';
		}
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
		$( '#rdpick_'+name_for_id).datepicker({
			changeYear: true,
			maxDate: maxDate,
			minDate: minDate,
			yearRange: minYear + ':' + maxYear,
			onClose: function(dateText, inst) {
				if (!dateText) {
					$(date_control).val('');
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

		$(date_control).bind('change',function(){
			var valDay   = elDay.val(),
				valMonth = elMonth.val(),
				valYear  = elYear.val();
			if (valDay && valMonth && valYear) {
				var dateObj = new Date(valYear,valMonth-1,valDay);
			} else {
				var dateObj = '';
			}
			$( '#rdpick_'+name ).datepicker('setDate',dateObj);
		});

		if (elYear.parent().data('uidtShowformat')) {
			target.append(' (' + $( '#rdpick_'+name_for_id).datepicker( "option", "dateFormat" )+')');
		}
	}
}

/**
 * Replaces Cotonti standard time selection boxes with unified timepicker
 * @param name - name of Select tags
 * @param targetPrefix - result will be placed in tag with class targetPrefix_name
 */
function replace_std_timepicker(name,targetPrefix){
	var name_for_id = name.replace(/[^\w+]/g,''),
		time_control = $("select[name='"+name+"[hour]']").parent(),
		elHour = time_control.find('select').filter("[name*='hour']"),
		elMinute = time_control.find('select').filter("[name*='minute']");

	if (elHour.length && elMinute.length) {
		var timepicker_template = '<input id="rtpick_'+name_for_id+'" type="text">';
		if (targetPrefix) {
			var target = $('.'+targetPrefix+'_'+name);
		} else {
			var target = elHour.parent().next('.uidt_timetarget');
		}
		target.html(timepicker_template);
		time_control.hide();
		var valHour   = elHour.val();
		var valMinute = elMinute.val();

		if (valHour && valMinute) {
			var timeStr = valHour + ':' +valMinute;
		} else {
			var timeStr = '';
		}
		$( '#rtpick_'+name_for_id).timepickr({
			trigger: 'mouseover',
			convention: 24,
			resetOnBlur: false,
			val: timeStr,
			select: function(){
				time = parse_time(this.value);
				if (time) {
					elHour.val(time[1]);
					elMinute.val(time[2]);
				}
				if (time == '' ) {
					$(time_control).val('');
				}
			}
		}).bind('blur',function(){
			var curHour   = elHour.val();
			var curMinute = elMinute.val();

			if (curHour && curMinute) {
				var timeStr = curHour + ':' +curMinute;
			} else {
				var timeStr = '';
			}
			$(this).val(timeStr);
		});
		$(time_control).bind('change',function(){
			var curHour   = elHour.val();
			var curMinute = elMinute.val();
			if (curHour && curMinute) {
				var timeStr = curHour + ':' +curMinute;
			} else {
				var timeStr = '';
			}
			$('#rtpick_'+name_for_id).val(timeStr);
		});

	}
}

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

$(function() {
	$('.uidt_date').each(function(i,e){
		var name = getInputName($(e).find('select').prop('name'));
		if (name) replace_std_datepicker(name,$(e).data('uidtPrefix'));
	});
	$('.uidt_time').each(function(i,e){
		var name = getInputName($(e).find('select').prop('name'));
		if (name) replace_std_timepicker(name,$(e).data('uidtPrefix'));
	});
});