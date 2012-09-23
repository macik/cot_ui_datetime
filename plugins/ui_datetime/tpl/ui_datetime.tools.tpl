<!-- BEGIN: MAIN -->
<h2>{PHP.L.uidt_testpage}</h2>
<!-- IF {PHP.cfg.jquery} -->
<script>
	$(function() {
		$('.dateFormat').html($( ".rdpick_testdate" ).datepicker( "option", "dateFormat" ));
		console.log('');
	});
</script>
<div class="block datetime_test" style="padding-top:15px;">
<table class="cells">
	<tbody>
	<tr>
		<th class="coltop"></th>
		<th class="coltop">{PHP.L.uidt_oldstyle}</th>
		<th class="coltop">{PHP.L.uidt_newstyle}</th>
	</tr>
		<tr>
			<td>{PHP.L.uidt_Date}</td>
			<td>{PHP.std_date}</td>
			<td><!-- IF {PHP.cfg.plugin.ui_datetime.enable_datepicker} -->
				<div class="target_testdate"></div>
				<!-- ELSE -->
				{PHP.L.uidt_switchedoff}
				<!-- ENDIF -->
			</td>
		</tr>
		<tr>
			<td>{PHP.L.uidt_Time}</td>
			<td>{PHP.std_time}</td>
			<td><!-- IF {PHP.cfg.plugin.ui_datetime.enable_timepicker} -->
				<div class="target_testtime"></div>
				<!-- ELSE -->
				{PHP.L.uidt_switchedoff}
				<!-- ENDIF -->
			</td>
		</tr>
	</tbody>
</table>
</div>
<!-- ELSE -->
<div class="demo">
	<p>{PHP.L.uidt_jqueryrequired}</p>
</div>
<!-- ENDIF -->
<!-- END: MAIN -->