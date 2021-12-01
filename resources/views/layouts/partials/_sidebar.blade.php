<nav class="col-md-2 d-none d-xl-block bg-light sidebar mt-5">
<div class="sidebar-sticky">
        <ul>
        @if (auth()->user()->isAdmin())
        <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('dashboard')) my-sidebar-list-active @endif ">
            <a  href="{{route('dashboard')}}"
                class="d-block nav-link">
                <i class="fa fa-th-large pr-2" aria-hidden="true"></i> Dashboard
            </a>
        </li>
        <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('billing')) my-sidebar-list-active @endif ">
            <a  href="{{route('billing')}}"
                class="d-block nav-link"><i class="fa fa-file-text-o pr-2" aria-hidden="true"></i> Billing
            </a>
        </li>

        <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('licenses')) my-sidebar-list-active @endif ">
            <a  href="{{route('licenses.index')}}"
                class="d-block nav-link"><i class="fa fa-barcode pr-2" aria-hidden="true"></i>Manage License
            </a>
        </li>
        <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('software')) my-sidebar-list-active @endif ">
            <a  href=""
                class="d-block nav-link "><i class="fa fa-cogs pr-2" aria-hidden="true"></i> Manage Software
            </a>
        </li>
        <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('user')) my-sidebar-list-active @endif ">
            <a  href=""
                class="d-block nav-link "><i class="fa fa-users pr-2" aria-hidden="true"></i>Manage Users
            </a>
        </li>
        @endif
    </ul>
</div>
</nav>
