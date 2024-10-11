<nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav" style="text-align: center ; over-flow-x:auto">
        <li class="nav-item sidebar-category">
  
         
        
        </li>

        </li>
   <li class="nav-item sidebar-category" style="margin-left: 3rem;    margin-top: 1px;">
   <div class="profile-image">
@if(empty(Auth::user()->image) && Auth::user()->gender== '1')
   <img src="{{ asset('admin/images/faces/face2.jpg' ) }}" alt="lavishLogo"
@elseif(empty(Auth::user()->image) && Auth::user()->gender== '0')
   <img src="https://lavishride.com/images/lavishLogo.webp" alt="lavishLogo">

@else
<div class="image-container" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;
">
    <img src="https://lavishride.com/images/lavishLogo.webp" alt="lavishLogo" style="  width: 100%; height: 100%;">
</div>
    @endif
   </div>
  
</li>
 
             
        </li>


        <li class="nav-item sidebar-category">
          <p>Pages</p>
          <span></span>
        </li>
   


    <li class="nav-item mb-5">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="mdi mdi-view-quilt menu-icon " style="color:#a3a4a5 "></i>
            <span class="menu-title" title="Dashnord">Dashboard</span>
        </a>
</li>

@can('view user')

<li class="nav-item mb-5">
        <a class="nav-link" href="{{ url('users') }}">
            <i class="mdi mdi-view-quilt menu-icon " style="color:#a3a4a5 "></i>
            <span class="menu-title" title="Dashnord">User</span>
        </a>
</li>
@endcan
@can('view role')

<li class="nav-item mb-5">
        <a class="nav-link" href="{{  url('roles') }}">
            <i class="mdi mdi-view-quilt menu-icon " style="color:#a3a4a5 "></i>
            <span class="menu-title" title="Dashnord">Role</span>
        </a>
</li>
@endcan

@can('view permission')


<li class="nav-item mb-5">
        <a class="nav-link" href="{{ url('permissions') }}">
            <i class="mdi mdi-view-quilt menu-icon " style="color:#a3a4a5 "></i>
            <span class="menu-title" title="Dashnord">permissions</span>
        </a>
</li>
@endcan


        <li class="mt-3">
         <a class="dropdown-item" href="{{ route('logout') }}" style=" font-size:17px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Log out">
                <i class="mdi mdi-logout text-primary "></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        
         <span class="fixed-sidebar" style="width: 12rem;
         ">


        </li>
             
    </ul>
</span>
</nav>