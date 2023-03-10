<?php
	$ph_calendar_color 			= get_option('ph_booking_settings_calendar_color') ;
	$ph_calendar_month_color 	= $ph_calendar_color['ph_calendar_month_color'] ;
	$booking_full_color 		= $ph_calendar_color['booking_full_color'];
	$selected_date_color 		= $ph_calendar_color['selected_date_color'];
	$booking_info_wraper_color 	= $ph_calendar_color['booking_info_wraper_color'];
	$ph_calendar_weekdays_color = $ph_calendar_color['ph_calendar_weekdays_color'];
	$ph_calendar_days_color 	= $ph_calendar_color['ph_calendar_days_color'];

	$ph_calendar_design=isset($ph_calendar_color['ph_calendar_design'])?$ph_calendar_color['ph_calendar_design']:'';

	?>
<style type="text/css">

	<?php if($ph_calendar_design==1 || empty($ph_calendar_month_color)){?>
		.single-product div.product form.cart
		{
			background-color: #1791ce !important;
		}
		.single-product div.product form.cart
		{
			background-color: #1791ce !important;
		}
		.booking-info-wraper{
			background: #ffffff !important;
		}
		.selected-date, .timepicker-selected-date, li.ph-calendar-date.mouse_hover, .time-picker-wraper #ph-calendar-time li.ph-calendar-date , li.ph-calendar-date.today:hover, .ph-calendar-date.today{
		    border: 0px solid transparent;
		}

		.time-picker-wraper #ph-calendar-time li.ph-calendar-date {
		    border: 1px solid #ffffff;
		}
		li.ph-calendar-date.mouse_hover, li.ph-calendar-date.today:hover, li.ph-calendar-date:hover{
		  background: #4fb5e9;
		}
		.ph-next:hover, .ph-prev:hover{
		  color: #4d8e7a ;
		}
		li.ph-calendar-date.de-active.booking-full:hover, .ph-calendar-date.booking-full {
		  background-color: #dadada;
		  cursor: text;
		}
		.ph_bookings_book_now_button,.ph_bookings_book_now_button:hover{
		  background-color: #1373a3 !important;
		    border: 1px #29aced !important;
		}
		.ph_bookings_book_now_button:before {
		  background: #2098D1;
		}
		<?php }
		else{?>
			.ph-calendar-month{
					background: <?php echo $ph_calendar_month_color ?> !important;
				}
				.booking-full{
					background: <?php echo $booking_full_color ?> !important;
				}
				.timepicker-selected-date, .selected-date{
					background: <?php echo $selected_date_color ?> !important;
				}
				.booking-info-wraper{
					background: <?php echo $booking_info_wraper_color ?> !important;
				}
				.ph-calendar-weekdays{
					background: <?php echo $ph_calendar_weekdays_color ?> !important;
				}
				.ph-calendar-days{
					background: <?php echo $ph_calendar_days_color ?> !important;
				}
		<?php }?>
</style>
<div class="time-picker-wraper">
	<input id="calender_type" value="time" type="hidden">
	<input type="hidden" id="book_interval_type" value="<?php echo $product->get_interval_type()?>">
	<input type="hidden" id="book_interval" value="<?php echo $product->get_interval()?>">

	<!-- <div class="callender-error-msg"></div> -->
	<?php
		$timezone = get_option('timezone_string');
		if( empty($timezone) ){
			$time_offset = get_option('gmt_offset');
			$timezone= timezone_name_from_abbr( "", $time_offset*60*60, 0 );
		}
		date_default_timezone_set($timezone);
		// Start date
		$month_start_date = date('Y').'-'.date('m').'-01';

		$this->phive_generate_date_calendar_for_timepicker($month_start_date);
	?>


	<ul class="ph-calendar-days" id="ph-calendar-days">	<?php

		$shop_opening_time 	= get_post_meta( $product->get_id(), "_phive_book_working_hour_start", 1 );

		$shop_opening_time = !empty( $shop_opening_time ) ? date( 'H:i',strtotime($shop_opening_time) ) : '00:00';

		$start_date = date('Y-m-d').' '.$shop_opening_time;
		// End date
		echo $this->phive_generate_days_for_period($month_start_date,'','','time-picker');
		?>
	</ul>
	<br>
	<div class="time-picker">
		<ul class="ph-calendar-days" id="ph-calendar-time">
			<center>
				<?php _e("Please Pick a Date", "furniture-rental-for-woocommerce")?>
			</center>
		</ul>
	</div>
</div>
<div class="booking-info-wraper">
	<p id="booking_info_text"> </p>
	<p id="booking_price_text"> </p>
</div>
