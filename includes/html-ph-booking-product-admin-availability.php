<style>
table.xa_availability_table {
	margin: 5px;
	width: 95%;
}
tr.rule td {
	padding: 5px;
	/*text-align: center;*/
	vertical-align: middle;
}

a.close {
	text-decoration: none;
    color: #d4d4d4;
}
td.remove:hover{
	cursor: pointer;
	background: #f00;
	color: #fff!important;
}
td.remove{
	text-align: center;;
}
.nonworking-wraper {
    padding: 10px;
}
.nonworking-title{
	display: inline-block;
}
.nonworking-title {
	width: 35%;
	line-height: 1.3;
	font-weight: 600;
}
i{
	font-size: 11px;
}

</style>
<div id='booking_availability' class='panel woocommerce_options_panel'>
	<?php
	$rules = get_post_meta( $post->ID, 'booking_availability_rules', 1 );
	if( empty($rules) ){
		$rule = array();
	}else{
		$rule = $rules[0];
	}?>
	<div class="" id="availability_wraper">
		<input type="hidden" name="ph_booking_is_bookable[]" value="no">
		<input type="hidden" name="ph_booking_availability_type[]" value="time-all">
		<div class="nonworking-wraper non-working-hours">
			<p class="form-field" >
				<label class="nonworking-title" style="width:30%"><?php _e('Non-working hours (All days)', 'furniture-rental-for-woocommerce') ?></label>
				<span><?php _e('From','furniture-rental-for-woocommerce') ?>&nbsp;&nbsp;<input type="time" class="time-picker" name="ph_booking_from_time[]" value="<?php echo isset($rule['from_time']) ? $rule['from_time'] : '' ?>" placeholder="HH:MM"></span>
				<span>&nbsp;&nbsp;&nbsp;<?php _e('To','furniture-rental-for-woocommerce') ?>&nbsp;<input type="time" class="time-picker" name="ph_booking_to_time[]" value="<?php echo isset($rule['to_time']) ? $rule['to_time'] : '' ?>" placeholder="HH:MM"></span>
				<br>
				<i><?php
				echo  __("Appointments within this period will appear blocked on the calendar.",'furniture-rental-for-woocommerce') ?>
				</i>
			</p>
		</div>
		<div class="nonworking-wraper">
			<p class="form-field" >
				<label class="nonworking-title" style="width:30%"><?php _e('Non-working days (Weekend)','furniture-rental-for-woocommerce') ?></label>
				<span><input type="checkbox" name="holiday_saturday" value="yes" <?php if( isset($rule['holiday_saturday']) && $rule['holiday_saturday']=='yes' ) echo "checked";?> > <?php _e('Saturday','furniture-rental-for-woocommerce') ?></span>
		  		<span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="holiday_sunday" value="yes" <?php if( isset($rule['holiday_sunday']) && $rule['holiday_sunday']=='yes') echo "checked";?>> <?php _e('Sunday','furniture-rental-for-woocommerce') ?></span>
		  		<br>
				<i><?php
				echo  __("If checked, these days would appear blocked on the calendar.",'furniture-rental-for-woocommerce') ?>
				</i>
			</p>
		</div>
	</div>
</div>
