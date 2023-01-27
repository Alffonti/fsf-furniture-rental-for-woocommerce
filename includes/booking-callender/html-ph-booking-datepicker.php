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
			background-color: #B48018 !important;
		}
		.single-product div.product form.cart
		{
			background-color: #B48018 !important;
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
        color: #0d0d0d !important;
		    background-color: #E3A731 !important;
		    border: 1px #E3A731 !important;
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

<?php $lang=get_bloginfo("language"); ?>
<div class="date-picker-wraper">
	<input type="hidden" id="book_interval_type" value="<?php echo $product->get_interval_type()?>">
	<input type="hidden" id="book_interval" value="<?php echo $product->get_interval()?>">
	<div class="ph-calendar-month">
		<ul>
			<li class="ph-prev" <?php echo (!empty($lang) && ($lang=='he-IL' || $lang=='he-HE'))?"style='float:right;'":'';?>>&#10094;</li>
			<li class="ph-next" <?php echo (!empty($lang) && ($lang=='he-IL' || $lang=='he-HE'))?"style='float:left;'":'';?>>&#10095;</li>
			<li>
				<div class="month-year-wraper">
					<span class="span-month"><?php echo date_i18n('F');?></span>
					<span class="span-year"><?php echo date_i18n('Y');?></span>

					<input type="text" readonly size="12" class="callender-month" value="<?php echo date('F');?>" style="opacity: 0 !important; filter: alpha(opacity=0)!important;">
					<input type="text" readonly size="5" class="callender-year" value="<?php echo date('Y');?>" style="opacity: 0 !important; filter: alpha(opacity=0)!important;">
				</div>
			</li>
		</ul>
	</div>

	<ul class="ph-calendar-weekdays">
		<li><?php _e("Mo", "furniture-rental-for-woocommerce")?></li>
		<li><?php _e("Tu", "furniture-rental-for-woocommerce")?></li>
		<li><?php _e("We", "furniture-rental-for-woocommerce")?></li>
		<li><?php _e("Th", "furniture-rental-for-woocommerce")?></li>
		<li><?php _e("Fr", "furniture-rental-for-woocommerce")?></li>
		<li><?php _e("Sa", "furniture-rental-for-woocommerce")?></li>
		<li><?php _e("Su", "furniture-rental-for-woocommerce")?></li>
	</ul>

	<ul class="ph-calendar-days" id="ph-calendar-days"><?php
		$timezone = get_option('timezone_string');
		if( empty($timezone) ){
			$time_offset = get_option('gmt_offset');
			$timezone= timezone_name_from_abbr( "", $time_offset*60*60, 0 );
		}
		date_default_timezone_set($timezone);

		// Start date
		$start_date = date('Y').'-'.date('m').'-01';
		echo $this->phive_generate_days_for_period($start_date);
		?>
	</ul>
</div>
<div class="booking-info-wraper">
	<div class="callender-error-msg"><?php _e('Please pick a booking period', 'furniture-rental-for-woocommerce')?></div>
	<p id="booking_info_text"> </p>
	<p id="booking_price_text"> </p>
</div>
