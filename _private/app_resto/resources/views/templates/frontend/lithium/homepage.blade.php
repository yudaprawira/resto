@extends( config('app.template') . 'layouts.master')

@section('content')
        <div class="pages">

          <div data-page="index" class="page homepage">
            <div class="page-content homepagecontent">	

            <div class="homenavbar">
                    <h1>KEMANA<span>GITU?</span></h1>								
            </div>
			
			<nav class="main-nav">
			    <ul>
                    <li style="background-image:url({{ $pub_url }}/jpg/bg-kuliner.jpeg);"><a href="kuliner" class="{{getClassBgTrans()}}"><img src="{{ $pub_url }}/png/icon-kuliner.png" alt="" title="" /><span>Kuliner</span></a></li>

                    <li class="navbg9"><a href="#" data-popup=".popup-login" class="open-popup {{getClassBgTrans()}}"><img src="{{ $pub_url }}/png/lock-2.png" alt="" title="" /><span>Login</span></a></li>
                    <li class="navbg10"><a href="#" data-panel="right" class="open-panel {{getClassBgTrans()}}"><img src="{{ $pub_url }}/png/users-2.png" alt="" title="" /><span>Account</span></a></li>
			    </ul>
			</nav>	    
            </div>
          </div>
        </div>
@endsection
