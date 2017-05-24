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

// Add main View
var mainView = myApp.addView('.view-main', {
    // Enable dynamic Navbar
    dynamicNavbar: false,
});


$(document).ready(function() {
		$("#RegisterForm").validate();
		$("#LoginForm").validate();
		$("#ForgotForm").validate();
		$(".close-popup").click(function() {					  
			$("label.error").hide();
		});

		authLogin();

		shareButton();
});

$$(document).on('pageInit', function (e) {
		//$("#RegisterForm").validate();
		//$("#LoginForm").validate();
		//$("#ForgotForm").validate();
		$(".close-popup").click(function() {					  
			$("label.error").hide();
		});

		//TOOLBAR
		if ( $('#setToolBar').length>0 )
		{
			initToolBar($('#setToolBar'));
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
myApp.onPageInit('contact', function (page) {
		$("#ContactForm").validate({
		submitHandler: function(form) {
		ajaxContact(form);
		return false;
		}
		});	
})
myApp.onPageInit('blog', function (page) {
 
		$(".posts li").hide();	
		size_li = $(".posts li").size();
		x=4;
		$('.posts li:lt('+x+')').show();
		$('#loadMore').click(function () {
			x= (x+1 <= size_li) ? x+1 : size_li;
			$('.posts li:lt('+x+')').show();
			if(x == size_li){
				$('#loadMore').hide();
				$('#showLess').show();
			}
		});

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

			if ( !firebase.auth().currentUser )
			{
				myApp.popup('.popup-login');
			}
			else if ( !readCookie('meja') )
			{
				myApp.popup('.popup-meja');
			}
			else
			{
				var postData = {
					id: $(this).data('id'),
					nama: $(this).data('nama'),
					foto: $(this).data('foto'),
					url: $(this).data('url'),
					jumlah: $(this).closest('.shop_item_details').find('.qntyshop').val(),
					status: 'pesan',
				};
				
				//PESANAN
				var type  = 'resto';
				var resto = $(this).data('resto');
				var user  = (firebase.auth().currentUser) ?  firebase.auth().currentUser.providerData[0].uid : null;
				var table = type + '/' + resto + '/' + 'pesanan' + '/' + user;
				
				AddUpdateDate(table, postData);

				/*//MEJA
				var type  = 'resto';
				var resto = $(this).data('resto');
				var user  = (firebase.auth().currentUser) ?  firebase.auth().currentUser.providerData[0].uid : null;
				var table = type + '/' + resto + '/' + 'meja';
				
				var postData = {
					id: 'meja-1',
					user: user,
				};

				AddUpdateDate(table, postData);*/
			}
		});
  
})
myApp.onPageInit('cart', function (page) {
			
    $('.item_delete').click(function(e){
        e.preventDefault();
        var currentVal = $(this).attr('id');
        $('div#'+currentVal).fadeOut('slow');
    });
  
})
myApp.onPageInit('photos', function (page) {
	$(".swipebox").swipebox();
	$("a.switcher").bind("click", function(e){
		e.preventDefault();
		
		var theid = $(this).attr("id");
		var theproducts = $("ul#photoslist");
		var classNames = $(this).attr('class').split(' ');
		
		
		if($(this).hasClass("active")) {
			// if currently clicked button has the active class
			// then we do nothing!
			return false;
		} else {
			// otherwise we are clicking on the inactive button
			// and in the process of switching views!

  			if(theid == "view13") {
				$(this).addClass("active");
				$("#view11").removeClass("active");
				$("#view11").children("img").attr("src","images/switch_11.png");
				
				$("#view12").removeClass("active");
				$("#view12").children("img").attr("src","images/switch_12.png");
			
				var theimg = $(this).children("img");
				theimg.attr("src","images/switch_13_active.png");
			
				// remove the list class and change to grid
				theproducts.removeClass("photo_gallery_11");
				theproducts.removeClass("photo_gallery_12");
				theproducts.addClass("photo_gallery_13");

			}
			
			else if(theid == "view12") {
				$(this).addClass("active");
				$("#view11").removeClass("active");
				$("#view11").children("img").attr("src","images/switch_11.png");
				
				$("#view13").removeClass("active");
				$("#view13").children("img").attr("src","images/switch_13.png");
			
				var theimg = $(this).children("img");
				theimg.attr("src","images/switch_12_active.png");
			
				// remove the list class and change to grid
				theproducts.removeClass("photo_gallery_11");
				theproducts.removeClass("photo_gallery_13");
				theproducts.addClass("photo_gallery_12");

			} 
			else if(theid == "view11") {
				$("#view12").removeClass("active");
				$("#view12").children("img").attr("src","images/switch_12.png");
				
				$("#view13").removeClass("active");
				$("#view13").children("img").attr("src","images/switch_13.png");
			
				var theimg = $(this).children("img");
				theimg.attr("src","images/switch_11_active.png");
			
				// remove the list class and change to grid
				theproducts.removeClass("photo_gallery_12");
				theproducts.removeClass("photo_gallery_13");
				theproducts.addClass("photo_gallery_11");

			} 
			
		}

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

//LOGIN // Logout
function authLogin()
{
	$(document).on('click', '#btn-login-google', function(){
		authGoogle();
		return false;
	});

	$(document).on('click', '#act-logout', function(){
		firebase.auth().signOut();
		window.location.reload();
		return false;
	});
}
function saveMember(type, data)
{
	$.ajax({
		type		: 'POST',
		url			: $('#form-login').data('store'),
		data        : 'type='+type+'&data='+JSON.stringify(data),
		beforeSend	: function(xhr) { loading(1) },
		success		: function(dt){
			if(dt) $('.user_login_info').replaceWith(dt);

			myApp.closeModal('.popup-login');
		},
	}).done(function(){ loading(0) }); 
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


/** REALTIME DATABASE **/
function AddUpdateDate(table, postData) 
{
	var ref = firebase.database().ref().child(table);
	var refMenuId = ref.orderByChild('id').equalTo(postData.id);
	refMenuId.once('value', function (snapshot) {
		if (snapshot.hasChildren()) 
		{
			snapshot.forEach(function (child) {
				child.ref.update(postData);
			});
		} 
		else 
		{
			snapshot.ref.push(postData);
		}
	});
}
function authGoogle()
{
	if (!firebase.auth().currentUser) 
	{
		var provider = new firebase.auth.GoogleAuthProvider();
		
		provider.addScope('https://www.googleapis.com/auth/contacts.readonly');

		firebase.auth().signInWithPopup(provider).then(function(result) {
		
			var token = result.credential.accessToken;

			var user = result.user;

			saveMember('google', user);
			
		}).catch(function(error) {
			var errorCode = error.code;
			var errorMessage = error.message;
			var email = error.email;
			var credential = error.credential;
			if (errorCode === 'auth/account-exists-with-different-credential') 
			{
				alert('You have already signed up with a different auth provider for that email.');
			} 
		});

	} 
	else 
	{
		saveMember('google', firebase.auth().currentUser);
	}
}