
    <div id="burger-menu">
        <span class="open-menu">
            <img src="{{ asset('assets/images/burger-menu.svg') }}" class="img-fluid" />
        </span>
        <span class="close-menu">
            <img src="{{ asset('assets/images/burger-menu-close.svg') }}" class="img-fluid" />
        </span>
    </div>
    <h3 class="heading-menu"> MAIN MENU </h3>

    <ul class="main-menu">
        <li class="menu-item @php echo (Request::path() == 'dashboard') ?  'active' : ''; @endphp">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/dashboard.png') }}" class="img-fluid" alt="">
                <span>Dashboard</span>
            </a>
        </li>

        <li class="menu-item @php echo (Request::path() == 'all-activities') ?  'active' : ''; @endphp">
            <a href="{{ route('all-activities') }}">
                <img src="{{ asset('assets/images/All-Activities.png') }}" class="img-fluid" alt="">
                <span>All Activities</span>
            </a>
        </li>

        <li class="menu-item  @php echo (Request::path() == 'my-activities') ?  'active' : ''; @endphp">
            <a href="{{ route('my-activities') }}">
                <img src="{{ asset('assets/images/locution-icon-2.png') }}" class="img-fluid" alt="">
                <span>My Activities</span>
            </a>
        </li>

        <li class="menu-item @php echo (Request::path() == 'documents') ?  'active' : ''; @endphp">
            <a href="{{ route('documents') }}">
                <img src="{{ asset('assets/images/Documents.png') }}" class="img-fluid" alt="">
                <span>Documents</span>
            </a>
        </li>

        <li class="menu-item @php echo (Request::path() == 'crew-members') ?  'active' : ''; @endphp">
            <a href="{{ route('crew-members') }}">
                <img src="{{ asset('assets/images/Crew.png') }}" class="img-fluid" alt="">
                <span>Crew Members</span>
            </a>
        </li>

        <li class="menu-item @php echo (Request::path() == 'activity-items') ?  'active' : ''; @endphp">
            <a href="{{ route('activity-items') }}">
                <img src="{{ asset('assets/images/Activity-Items.png') }}" class="img-fluid" alt="">
                <span>Activity Items</span>
            </a>
        </li>

        <li class="menu-item @php echo (Request::path() == 'analytics') ?  'active' : ''; @endphp">
            <a href="{{ route('analytics') }}">
                <img src="{{ asset('assets/images/Analysis.png') }}" class="img-fluid" alt="">
                <span>Analysis</span>
            </a>
        </li>

        <li class="menu-item @php echo (Request::path() == 'my-account') ?  'active' : ''; @endphp">
            <a href="{{ route('my-account') }}">
                <img src="{{ asset('assets/images/My-Account.png') }}" class="img-fluid" alt="">
                <span>My Account</span>
            </a>
        </li>

        <li class="menu-item @php echo (Request::path() == 'settings') ?  'active' : ''; @endphp">
            <a href="{{ route('settings') }}">
                <img src="{{ asset('assets/images/Setting.png') }}" class="img-fluid" alt="">
                <span>Settings</span>
            </a>
        </li>

        <li class="menu-item">

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img src="{{ asset('assets/images/Logout.png') }}" class="img-fluid" alt=""> <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </li>
    </ul>



    <p class="last-text">

        CCT Activity Manager <br>

        Maintained by Voteq

    </p>
