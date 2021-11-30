<nav class="col-md-2 d-none d-md-block bg-light sidebar mt-5">
<div class="sidebar-sticky">
        <ul>
        @if (auth()->user()->isAdmin())
        <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('dashboard')) my-sidebar-list-active @endif ">
            <a  href=""
                class="d-block nav-link">
                <i class="fa fa-th-large pr-2" aria-hidden="true"></i> Dashboard
            </a>
        </li>
        <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('billing')) my-sidebar-list-active @endif ">
            <a  href=""
                class="d-block nav-link"><i class="fa fa-file-text-o pr-2" aria-hidden="true"></i> Billing
            </a>
        </li>

        <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('license')) my-sidebar-list-active @endif ">
            <a  href=""
                class="d-block nav-link"><i class="fa fa-barcode pr-2" aria-hidden="true"></i>Manage License
            </a>
            {{-- <div class="d-none sub-courses ">
                <ul class="sub-courses-list">
                    <li class="my-sidebar-list my-sidebar-list-shadow @if (request()->is('product')) my-sidebar-list-active @endif ">
                        <a href="">aa</a>
                    </li>
                </ul>
            </div> --}}
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
