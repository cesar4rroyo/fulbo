<!-- Authentication Links -->
@guest
    <li class="nav-item">
        <a class="nav-link"
           href="{{ route('login') }}"> Login
        </a>
    </li>
@else
    <li class="nav-item dropdown">
        <a id="navbarDropdown"
           class="nav-link dropdown-toggle"
           href="#"
           role="button"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
           v-pre>
            {{ Auth::user()->name }}

            <span class="font-weight-bold text-uppercase">
                @switch(\Illuminate\Support\Facades\Auth::user()->level)
                    @case(\App\Enums\UserLevel::ADMIN_UTAMA)
                        (Admin Utama)
                    @break
                    @case(\App\Enums\UserLevel::ADMIN_PENYEWAAN)
                        (Admin {{ auth()->user()->tempat_penyewaan->nama }})
                    @break
                    @case(\App\Enums\UserLevel::PENYEWA)
                        (Cliente)
                    @break
                @endswitch
            </span>

            <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right"
             aria-labelledby="navbarDropdown">
            <a class="dropdown-item"
               href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST"
                  style="display: none;">
                @csrf
            </form>
        </div>
    </li>
@endguest
