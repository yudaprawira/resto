// Initialize your app
var myApp = new Framework7({
    animateNavBackIcon: true,
    // Enable templates auto precompilation
    precompileTemplates: true,
    // Enabled pages rendering using Template7
	swipeBackPage: false,
	swipePanelOnlyClose: true,
	pushState: true,
    template7Pages: true
});


// Export selectors engine
var $$ = Dom7;
var ypAuth = new ypFireBase();

// Add main View
var mainView = myApp.addView('.view-main', {
    // Enable dynamic Navbar
    dynamicNavbar: false,
});


$(document).ready(function() {
		
	$(".close-popup").click(function() {					  
		$("label.error").hide();
	});

	//registering button
	$(document).on('click', '#btn-login-google', function(){
		ypAuth.auth('google'); return false;
	});
	$(document).on('click', '#btn-login-twitter', function(){
		ypAuth.auth('twitter'); return false;
	});
	$(document).on('click', '#btn-login-facebook', function(){
		ypAuth.auth('facebook'); return false;
	});
	$(document).on('click', '#act-logout', function(){
		ypAuth.auth('logout'); return false;
	});

	shareButton();

	$(document).on('change', '.pilih-meja', function(){
		var member_id = $('#dataMember').attr('data-memberid');
		var resto = $(this).data('resto');

		if ( member_id && resto )
		{
			var ypResto = new ypFireBaseResto(resto, 'meja');

			ypResto.setMeja(parseInt($(this).val()), member_id);
			myApp.closeModal('.popup-meja');

			$('body').attr('resto-'+resto, 'meja-'+$(this).val());
				
			swal({
				title: "NOMOR "+($(this).closest('span').find('label').text()).toUpperCase(),
				type : "success",
				html : true,
				text : '<a href="#" onclick="myApp.popup(\'.popup-meja\'); swal.close(); return false;">Ganti nomor meja</a>',
			});
		}
	});
});

$$(document).on('pageInit', function (e) {
	
	$(".close-popup").click(function() {					  
		$("label.error").hide();
	});

	//TOOLBAR
	if ( $('#setToolBar').length>0 )
	{
		initToolBar($('#setToolBar'));
	}

	//MEMBER
	if ( $('#dataMember').attr('data-memberid') )
	{
		var member_id = $('#dataMember').attr('data-memberid');
		var state_active = $('#dataMember').attr('data-state');
		
		if ( member_id )
		{
			var ypUser = new ypFireBase("member");
				ypUser.offline(member_id).update({'online':false});

				if ( !$('body').attr('member-online') )
				{
					ypUser.online(member_id);
					ypUser.memberOnline();
					$('body').attr('member-online', true);
					$('.icon-user').attr('src', $('.icon-user').attr('src-online'));
				}

			//cek pelayan online
			if ( state_active )
			{
				 var ypPelayan = new ypFireBaseResto(state_active, "user/resto-pelayan");
				 	 ypPelayan.statusPelayan();
			}
		}
		else
		{
			$('body').removeAttr('member-online');
			$('.icon-user').attr('src', $('.icon-user').attr('src-offline'));
		}
	}
})

myApp.onPageInit('about', function (page) {
	//READMORE
	$('.description').readmore({
		moreLink: '<a href="#" class="link-more">Selengkapnya</a>',
		lessLink: ''
	});	
	//MAP
	if( $('.showMap').length>0 )
	{
		$('.showMap').each(function(){
			initMap($(this));
		});
	}
})

myApp.onPageInit('shop', function (page) {
			
	$('.qntyplusshop').click(function(e){
									
		e.preventDefault();
		var fieldName = $(this).attr('field');
		var currentVal = parseInt($('input[name='+fieldName+']').val());
		if (!isNaN(currentVal)) {
			$('input[name='+fieldName+']').val(currentVal + 1);
		} else {
			$('input[name='+fieldName+']').val(1);
		}
		
	});
	$(".qntyminusshop").click(function(e) {
		e.preventDefault();
		var fieldName = $(this).attr('field');
		var currentVal = parseInt($('input[name='+fieldName+']').val());
		if (!isNaN(currentVal) && currentVal > 1) {
			$('input[name='+fieldName+']').val(currentVal - 1);
		} else {
			$('input[name='+fieldName+']').val(1);
		}
	});	
	$(".addtocart").click(function(e){
		e.preventDefault();

		var resto = $(this).data('resto');
		var member_id = $('#dataMember').attr('data-memberid') ? $('#dataMember').attr('data-memberid') : null;
				
		//cek member online
		if ( $('body').attr('member-online') )
		{
			//cek pelayan
			if (!$('body').attr('pelayan-'+resto) )
			{
				swal({
					title: "TIDAK DAPAT DILANJUTKAN",
					type : "error",
					text : 'Mohon maaf, saat ini tidak ada pelayang yang online. Silakan kembali lagi dalam beberapa menit',
					closeOnConfirm: false,
					showLoaderOnConfirm: true,
				},
				function(){
					setTimeout(function(){
						if (!$('body').attr('pelayan-'+resto) )
						{
							swal.close();
						}
						else
						{
							swal({
								title: "PELAYAN ONLINE",
								type : "success",
								text : 'Silakan melanjutkan pesanan Anda.'
							})
						}
					}, 2000);
				});

				return false;
			}

			//cek meja
			if (!$('body').attr('resto-'+resto) )
			{
				if ( member_id )
				{
					var ypMember = new ypFireBase('member');
					var rowUser = ypMember.get(member_id);

					rowUser.once('value', function (snapshot) {
						if ( snapshot.numChildren()>0 )
						{
							if ( snapshot.val().nama )
							{
								var ypMeja = new ypFireBaseResto(resto, 'meja');
								ypMeja.viewMeja(member_id);
							}
							else
							{
								myApp.popup('.popup-login');	
							}
						}
						else
						{
							myApp.popup('.popup-login');
						}
					});
				}
				else
				{
					myApp.popup('.popup-login');
				}

			}
			else
			{
				alert('update pesanan');
			}
		}
		else
		{
			myApp.popup('.popup-login');
		}
	});  
})
myApp.onPageInit('cart', function (page) {
			
    $('.item_delete').click(function(e){
        e.preventDefault();
        var currentVal = $(this).attr('id');
        $('div#'+currentVal).fadeOut('slow');
    });
  
});

function loading(status)
{

}

//ToolBar
function initToolBar(el)
{
	$('#toolbarHome').attr('href', el.data('home'));
}

//SHARE
function shareButton()
{
	$(document).on('click', '.shopfav', function(){
		var href = $(this).attr('href');
		var title = $(this).attr('title');
		var url_facebook = 'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(href);
		var url_twitter = 'http://twitter.com/share?via=juarain&url='+encodeURIComponent(href)+'&text='+encodeURIComponent(title);
		var url_google = 'https://plus.google.com/share?url='+encodeURIComponent(href);

		$('#url-share-facebook').attr('href', url_facebook);
		$('#url-share-twitter').attr('href', url_twitter);
		$('#url-share-google').attr('href', url_google);
	});
}

//MAP
function initMap(target)
{
	 var map = new google.maps.Map(
        document.getElementById(target.attr('id')), {
          center: new google.maps.LatLng(target.data('lat'), target.data('lng')),
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var marker = new google.maps.Marker({
            position: new google.maps.LatLng(target.data('lat'), target.data('lng')),
            map: map
      });

	  var infowindow = new google.maps.InfoWindow({
          content: target.data('info')
      });

	  infowindow.open(map, marker);

	  marker.addListener('click', function() {
          infowindow.open(map, marker);
      });

	  	//get location
		/*if (navigator.geolocation) {
			var currentPosition = null;
			navigator.geolocation.getCurrentPosition(function(position) {

				var directionsDisplay = new google.maps.DirectionsRenderer;
		        var directionsService = new google.maps.DirectionsService;
				directionsDisplay.setMap(map);

				
				directionsService.route({
				origin: {lat: position.coords.latitude, lng: position.coords.longitude},
				destination: {lat: target.data('lat'), lng: target.data('lng')},
				// Note that Javascript allows us to access the constant
				// using square brackets and a string value as its
				// "property."
				travelMode: google.maps.TravelMode['DRIVING']
				}, function(response, status) {
				if (status == 'OK') {
					directionsDisplay.setDirections(response);
				} else {
					window.alert('Directions request failed due to ' + status);
				}
				});

			});
		}*/
	  
}