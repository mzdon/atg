/**
 * Slider Setting
 * 
 * Contains all the slider settings.
 * override these globally 
 */
 
jQuery(window).load(function() {							 
	var transition_effect = atg_slider_value.transition_effect;
	var transition_delay = atg_slider_value.transition_delay;
	var transition_duration = atg_slider_value.transition_duration;
	jQuery('.slider-cycle').cycle({ 
		fx: transition_effect, 
		//pager: '#controllers',
		activePagerClass: 'active',
		timeout: transition_delay,
		speed: transition_duration,
		width: '100%',
		height: '100%',
		containerResize: 0,
		fit: 1,
		after: function ()	{
			jQuery(this).parent().css("height", jQuery(this).height());
			jQuery( '.active-slide' ).removeClass( 'active-slide' );
			jQuery( this ).addClass( 'active-slide' );
		},
	   cleartypeNoBg: true,
	});
	jQuery('.highlight-cycle').cycle({ 
		fx: transition_effect, 
		//pager: '#highlight-controllers',
		activePagerClass: 'active',
		timeout: transition_delay,
		speed: transition_duration,
		width: '100%',
		containerResize: 0,
		fit: 1,
		/*after: function ()	{
			jQuery(this).parent().css("height", jQuery(this).height());
			jQuery( '.active-slide' ).removeClass( 'active-slide' );
			jQuery( this ).addClass( 'active-slide' );
		},*/
	   cleartypeNoBg: true,
	});
});
