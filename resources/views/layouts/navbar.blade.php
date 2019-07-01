<!-- Grid column -->
    <nav class="nav flex-column py-4 mb-r z-depth-1 stylish-color-dark text-white" style="height: 100%;">
        <div style="padding: 0px 8px";>
            <div class="media d-block d-md-flex" style="padding: 0px 8px;"><?php $user_profile = Auth::user()->profile; ?>
                <img class="d-flex rounded-circle avatar z-depth-1-half mb-3 mx-auto" src="{{ asset("storage/".$user_profile."")}}"
                     alt="Avatar" width="60" height="60">
                <div class="media-body text-center text-md-left ml-md-3 ml-0">
                    {{ Auth::user()->name }}
                    <hr style="color: white; background: white;">
                </div>
            </div>
            <li class="nav-item"><a class="nav-link white-text" href="/messages/create"><i class="fa fa-pencil"> </i> compose </a> </li>
            <li class="nav-item"><a class="nav-link white-text" href="/inbox"><i class="fa fa-inbox"> </i> Inbox </a> </li>
            <li class="nav-item"><a class="nav-link white-text" href="/sentmessages"><i class="fa fa-paper-plane"> </i> sent box </a></li>
            <li class="nav-item"><a class="nav-link white-text" href="/draftmessages"><i class="fa fa-save"></i> Draft messages </a></li>
            <li class="nav-item"><a class="nav-link white-text" href="/transactions"><i class="fa fa-money"> </i> My transaction </a></li>
            <li class="nav-item"><a class="nav-link white-text" href="/messages/create"><i class="fa fa-paper-plane-o"> </i> Email marketing </a></li>
            <li class="nav-item"><a class="nav-link white-text" href="/download_contact_template"><i class="fa fa-download"> </i> Downloads </a>
            </li>
            <li class="nav-item"><a class="nav-link white-text" href="statistics"><i class="fa fa-line-chart"> </i> Statistics </a> </li>
            <li class="nav-item"><a class="nav-link white-text" href="/groups"><i class="fa fa-users"> </i> Manage groups </a> </li>
            <li class="nav-item"><a class="nav-link white-text" href="/contacts/create"><i class="fa fa-upload"> </i> Uplaod Contacts </a> </li>
            <li class="nav-item"><a class="nav-link white-text" href="/contacts"><i class="fa fa-calendar"> </i> Contacts </a> </li>

            <style>
                ul{list-style: none;}
            </style>
            @if( auth::user()->role_id == null)

            @else
                @foreach( auth::user()->role()->first()->privileges()->get() as $privilege )
                    <li class="nav-item"><a class="nav-link white-text" href="{{ $privilege->url }}"><i class="{{$privilege->image}}"> </i> {{ $privilege->name }} </a></li>
                @endforeach
            @endif
            <li><a class="waves-effect nav-link white-text" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"> Logout </i>
                </a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </nav>
<!-- Grid column -->