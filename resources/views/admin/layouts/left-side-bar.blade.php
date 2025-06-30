<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{route('home')}}">
            <img src="{{asset('assets/vendors/images/deskapp-logo.svg')}}" alt="" class="dark-logo">
            <img src="{{asset('assets/vendors/images/deskapp-logo-white.svg')}}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">        
                <li>
                    <a href="{{route('home')}}" class="dropdown-toggle no-arrow {{ Request::is('home') ? 'active' : '' }}">
                        <span class="micon dw dw-right-arrow1"></span><span class="mtext">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('challance.index')}}" class="dropdown-toggle no-arrow {{ Request::is('challance') ? 'active' : '' }}">
                        <span class="micon dw dw-right-arrow1"></span><span class="mtext">Delivery Challans</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>