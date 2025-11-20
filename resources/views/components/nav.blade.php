<div class="header-top">
    <h1>SeekMed</h1>
     <nav class="top-nav desktop-nav">
        <a href={{route('home')}}><span class={{request()->routeIs('home')?'active':''}}>Home</span></a>
        <a href={{route('dashboard')}}><span class={{request()->routeIs('dashboard')?'active':''}}>Dashboard</span>
        <a href={{route('forum')}}><span class={{request()->routeIs('forum')?'active':''}}>Forum</span></a>
        <a href={{route('user.profile', Auth::user())}} class="profile-link"><img src="{{Auth::user()->profile_picture_data}}" alt="Profile Picture"/></a>
    </nav>
</div>