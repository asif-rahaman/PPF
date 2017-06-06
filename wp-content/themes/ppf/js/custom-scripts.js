jQuery(document).ready( function(){	 
	//jQuery('.paralax-border-effect').parallax({imageSrc: 'http://localhost/sei/ppf/wp-content/themes/ppf/images/paralax.jpg'},{parallax:'scroll'},{bleed:'10'},{speed:'0.2'},{naturalWidth:'1600'},{naturalHeight:'600'},{style:'height:246px'});
	
	jQuery(".nav-primary").sticky({ topSpacing: 0 });

	if( jQuery('.rating span').length > 0 ) {
		jQuery(".rating span").each(function(){
			var rating = jQuery(this).attr("data-rating");
			jQuery(this).addClass("rating-" + rating );
		});
	}
	
	/* Adding Responsive menu label */
	jQuery( '.responsive-menu-icon' ).html( '<span><i class="fa fa-bars"></i> MENU</span>' );
	

	/* Adding Classes for Animations */
	jQuery( '.more-link, .gform_button, .contact-us-slider a').addClass( 'hvr-shutter-out-horizontal' );

	/* Adding Header Image Effects */
    jQuery('.header-banner img').toggleClass( 'animated slideInDown' );
    jQuery('.header-banner img').css('opacity','1');
	jQuery('.home-section-3 article > a').wrap( "<div class='image-wrapper'></div>" );
	
	if( jQuery('.inner-page').length > 0 ) {
		if( jQuery('.full-width-content .entry-content .wrapper-dev').length > 0 ) {
			// do something here
		} else {
		   // Add Wrapper
		   jQuery( ".full-width-content .entry-content" ).wrapAll( "<div class='wrapper-dev'><div class='wrap' />");
		}
	}
	
	jQuery('#menu-main-menu > li > a, .sei-social-links a').hover( function(){
		jQuery(this).find(".fa").toggleClass( "animated zoomIn" );
	});
	

	jQuery( ".attachment-yarpp-thumbnail" ).each( function(){
		jQuery(this).wrapAll( "<span class='yarpp-thumbnail-container'/>");
	});
	
	jQuery(".yarpp-post-title").on('hover', function(){
		var parent = jQuery(this).parents('.yarpp-thumbnail');
		parent.find('.yarpp-thumbnail-container img').toggleClass("hover");
	});
	
	jQuery(".yarpp-thumbnail-container img").on('hover', function(){
		jQuery(this).toggleClass("hover");
	});
	
	// jQuery(".home-section-1").backstretch( window.location.href  + "/wp-content/themes/seibase/images/mesh.jpg");
	
	// var single_featured_image = jQuery(".entry-background .full-featured-bg .original-featured-image").attr("src");
	
	// if (typeof single_featured_image !== 'undefined') {
		
	// 	if(single_featured_image.length > 0 ) {
	// 		jQuery(".single-hero-container").backstretch( single_featured_image, {
	// 			alt: jQuery(".entry-background .full-featured-bg .original-featured-image").attr("alt")
	// 		});
	// 		jQuery(".entry-background .full-featured-bg .original-featured-image").hide();
	// 	}
	// }
	
	jQuery('.home-section-2 .widget.featuredpage .entry-header').matchHeight(
		{
			byRow: true,
			property: 'height',
			target: null,
			remove: false
		}
	);
	
	jQuery('.home-section-2 .widget.featuredpage').matchHeight(
		{
			byRow: true,
			property: 'height',
			target: null,
			remove: false
		}
	);
	
	jQuery('.home-section-2 .widget.featuredpage .entry-content').matchHeight(
		{
			byRow: true,
			property: 'height',
			target: null,
			remove: false
		}
	);
	
	/* back to top */
	var offset = 220;
	var duration = 500;
	
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > offset) {
			jQuery('.back-to-top').fadeIn(200);
			jQuery('.scroll-to-bottom').hide();
		} else {
			jQuery('.scroll-to-bottom').fadeIn(200);
			jQuery('.back-to-top').hide();
		}
	});

	jQuery('.back-to-top').click(function(event) {
		event.preventDefault();
		jQuery('html, body').animate({scrollTop: 0}, duration);
		return false;
	});
	
	jQuery('.scroll-to-bottom').click(function(event) {
		event.preventDefault();
		jQuery('html, body').animate({ scrollTop:  jQuery( window ).height() }, duration);
		return false;
	});
	
	jQuery('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = jQuery(this.hash);
		  target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			jQuery('html,body').animate({
			  scrollTop: target.offset().top
			}, 800 );
			return false;
		  }
		} 
	});
	
	jQuery(".sei-social-share .sei-link a").on('click', function(event){
		event.preventDefault();
		var url = jQuery(this).attr("href");
		var name = jQuery(this).attr("class");
		
		if (typeof ga !== 'undefined' && typeof ga === 'function') {
			ga('send', {
			  hitType: 'social',
			  socialNetwork: name,
			  socialAction: 'share',
			  socialTarget: url
			});
		}

		//if( name !== 'twitter') {
			window.open(url, name,"toolbar=no, menubar=no,scrollbars=no,resizable=no,location=no,directories=no,status=no,width=650, height=450, left=0, top=0'");
		//}
	});
	
	
	/* You can add animations. See Animation Types: http://daneden.github.io/animate.css/ */
});