<div class="left-side-bar">
    <div class="brand-logo">
        <label for="" class="text-white m-4 pl-4">
            DASHBOARD
        </label>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">        
                <li>
                    <a href="{{ route('user.home') }}" class="dropdown-toggle no-arrow {{ Request::is('agent/home') ? 'active' : '' }}">
                        <span class="micon dw dw-right-arrow1"></span><span class="mtext">Home</span>
                    </a>
                </li>
               
               
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>