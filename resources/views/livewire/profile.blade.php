<div>
    @auth
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasProfile"
            aria-labelledby="Profil Saya" wire:ignore.self>
            <div class="offcanvas-header justify-content-between">
                <h5 class="offcanvas-title" id="Profil Saya">My Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="profile-header text-center mb-4">
                    @if (Auth::check())
                        <h3 class="display-4 mb-2">{{ Auth::user()->nama_depan }}</h3>
                        @if (Auth::user()->member)
                            <p class="lead">Points: <span
                                    class="badge bg-primary">{{ Auth::user()->member->points }}</span>
                            </p>
                        @endif
                    @endif
                </div>

                <ul class="list-group mt-4">
                    @if (Auth::user()->phone == null && Auth::user()->email_verified_at == null)
                        <li class="list-group-item">
                            <a href="{{ route('settings') }}" class="text-decoration-none">
                                Settings
                                <span class="badge bg-danger text-white ml-2">2</span> <!-- Badge dengan angka 2 -->
                            </a>
                        </li>
                    @elseif (Auth::user()->phone == null || Auth::user()->email_verified_at == null)
                        <li class="list-group-item">
                            <a href="{{ route('settings') }}" class="text-decoration-none">
                                Settings
                                <span class="badge bg-danger text-white ml-2">1</span>
                                <!-- Badge dengan angka 1 jika salah satu kosong -->
                            </a>
                        </li>
                    @else
                        <li class="list-group-item">
                            <a href="{{ route('settings') }}" class="text-decoration-none">
                                Settings
                            </a>
                        </li>
                    @endif

                    <li class="list-group-item">
                        <a href="{{ route('historyOrder') }}" class="text-decoration-none">Order History</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('course.history') }}" class="text-decoration-none">Course History</a>
                    </li>
                    <li class="list-group-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                                class="mx-0 item-anchor">
                                Log Out
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    @endauth
</div>
