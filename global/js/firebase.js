//LOGIN // Logout
function authLogin()
{
	$(document).on('click', '#btn-login-google', function(){
		authWith('google');
		return false;
	});

	$(document).on('click', '#btn-login-facebook', function(){
		authWith('facebook');
		return false;
	});

	$(document).on('click', '#btn-login-twitter', function(){
		authWith('twitter');
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
/** REALTIME DATABASE **/
function AddUpdateDate(table, postData) 
{
	var ref = firebase.database().ref().child(table);
	var refId = ref.orderByChild('id').equalTo(postData.id);
	refId.once('value', function (snapshot) {
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

function authWith(type)
{
	if (!firebase.auth().currentUser) 
	{
		if ( type=='google' )
		{
			var provider = new firebase.auth.GoogleAuthProvider();
			
			provider.addScope('https://www.googleapis.com/auth/contacts.readonly');
		}
		else if( type=='facebook' )
		{
			var provider = new firebase.auth.FacebookAuthProvider();
			
			provider.addScope('user_birthday');
		}
		else if( type=='twitter' )
		{
			var provider = new firebase.auth.TwitterAuthProvider();
		}

		firebase.auth().signInWithPopup(provider).then(function(result) {
		
			var token = result.credential.accessToken;

			var user = result.user;

			saveMember(type, user);
			
		});
	} 
	else 
	{
		saveMember(type, firebase.auth().currentUser);
	}
}