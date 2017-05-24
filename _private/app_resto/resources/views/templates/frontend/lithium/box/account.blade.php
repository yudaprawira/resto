<div class="user_login_info">

    <div class="user_thumb">
        <img src="{{ $pub_url }}/jpg/page_photo2.jpg" alt="" title="" />
        <div class="user_details">
            <p>Selamat datang, <span>{{ val($row, 'nama') }}</span></p>
        </div>  
        <div class="user_avatar"><img src="{{ val($row, 'foto') }}" alt="" title="" /></div>       
    </div>

    <nav class="user-nav">
        <ul>
            <li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/settings.png" alt="" title="" /><span>Account Settings</span></a></li>
            <li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/briefcase.png" alt="" title="" /><span>My Account</span></a></li>
            <li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/message.png" alt="" title="" /><span>Messages</span><strong>12</strong></a></li>
            <li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/love.png" alt="" title="" /><span>Favorites</span><strong>5</strong></a></li>
            <li><a href="#" class="close-panel" id="act-logout"><img src="{{ $pub_url }}/png/lock.png" alt="" title="" /><span>Logout</span></a></li>
        </ul>
    </nav>
</div>