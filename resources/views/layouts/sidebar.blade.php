<div class="sidebar sidebar-style-2" data-background-color="danger">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user pb-2">
                <div class="avatar-lg float-left mr-2">
                    @if (auth()->user()->avatar != null)
                        <img src="{{ asset('profile/' . auth()->user()->avatar) }}" alt="..."
                            class="avatar-img rounded-circle">
                    @else
                        <i class="fas fa-user-circle fa-3x text-white" aria-hidden="true"></i>
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span class="text-white">
                            {{ auth()->user()->nama }}
                            <span class="user-level text-white">{{ Str::upper(auth()->user()->level) }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li
                    class="nav-item {{ request()->is('admin') || request()->is('supporter') ? 'active' : '' }}">
                    <a href="{{ route(auth()->user()->level) }}">
                        <i class="fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                @if (auth()->user()->level == 'admin' || auth()->user()->level == 'supporter')
                    @if (auth()->user()->level == 'admin' || auth()->user()->level == 'supporter')
                        <li class="nav-item {{ request()->is('pengurus') ? 'active' : '' }}">
                            <a href="{{ route('pengurus') }}">
                                <i class="icon icon-people"></i>
                                <p>Pengurus</p>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->level == 'admin' || auth()->user()->level == 'supporter')
                        <li class="nav-item {{ request()->is('pemains') ? 'active' : '' }}">
                            <a href="{{ route('pemain') }}">
                                <i class="fas fa-futbol"></i>
                                <p>Pemain</p>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->level == 'admin')
                        <li
                            class="nav-item {{ request()->is('danamasuk') || request()->is('danakeluar') || request()->is('danasaatini') ? 'active' : '' }}">
                            <a data-toggle="collapse" href="#forms" class="collapsed" aria-expanded="false">
                                <i class="icon icon-wallet"></i>
                                <p>Keuangan</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="forms" style="">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('danamasuk') ? 'active' : '' }}">
                                        <a href="{{ route('danamasuk') }}">
                                            <span class="sub-item">Dana Masuk</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('danakeluar') ? 'active' : '' }}">
                                        <a href="{{ route('danakeluar') }}">
                                            <span class="sub-item">Dana Keluar</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('danasaatini') ? 'active' : '' }}">
                                        <a href="{{ route('danasaatini') }}">
                                            <span class="sub-item">Dana saat ini</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if (auth()->user()->level == 'admin'|| auth()->user()->level == 'supporter')
                        <li class="nav-item {{ request()->is('inventaris') ? 'active' : '' }}">
                            <a href="{{ route('inventaris') }}">
                                <i class="icon icon-briefcase"></i>
                                <p>Inventaris</p>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->level == 'admin' || auth()->user()->level == 'supporter')
                        <li class="nav-item {{ request()->is('datasupporter') ? 'active' : '' }}">
                            <a href="{{ route('datasupporter') }}">
                                <i class="fas fa-users"></i>
                                <p>Supporter</p>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->level == 'admin' || auth()->user()->level == 'supporter')
                        <li class="nav-item {{ request()->is('jadwals') ? 'active' : '' }}">
                            <a href="{{ route('jadwal') }}">
                                <i class="icon icon-calendar"></i>
                                <p>Jadwal</p>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->level == 'admin' || auth()->user()->level == 'supporter')
                        <li class="nav-item {{ request()->is('galeris') ? 'active' : '' }}">
                            <a href="{{ route('galeri') }}">
                                <i class="icon icon-picture"></i>
                                <p>Galeri</p>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
