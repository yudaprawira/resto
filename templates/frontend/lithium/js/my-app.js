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
		
	$(".close-popup").click(function() {					  
		$("label.error").hide();
	});

	authLogin();

	shareButton();

	$(document).on('change', '.pilih-meja', function(){
		var resto = $(this).data('resto');
		createCookie(resto + '-meja', $(this).val());
        updateMejaUser(resto, parseInt($(this).val()), 'standart');
        //myApp.closeModal('.popup-meja');
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

		if ( !firebase.auth().currentUser )
		{
			myApp.popup('.popup-login');
		}
		else if ( !readCookie($(this).data('resto')+'-meja') )
		{
			statusMeja($(this));
		}
		else
		{
			updatePesanan($(this));
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