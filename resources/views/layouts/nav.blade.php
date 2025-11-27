<nav>
<style>
/* ---------------------------------------------------
   NAVBAR — Deep Blue + Purple Accent
--------------------------------------------------- */
nav {
    font-family: 'Inter', sans-serif;
    background: #1E3A8A;
    padding: 14px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.15);
    position: sticky;
    top: 0;
    z-index: 100;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

/* MENU LINKS */
.menu {
    display: flex;
    gap: 22px;
}

.menu a {
    text-decoration: none;
    color: #E0E7FF;
    font-weight: 500;
    font-size: 15px;
    padding: 8px 14px;
    border-radius: 8px;
    transition: 0.25s ease;
    position: relative;
}

.menu a:hover {
    background: rgba(255,255,255,0.18);
    color: #ffffff;
    transform: translateY(-2px);
}

/* ACTIVE STATE */
.menu a.active::after {
    content: "";
    position: absolute;
    bottom: -4px;
    left: 20%;
    width: 60%;
    height: 3px;
    background: #A855F7;
    border-radius: 10px;
}

/* PROFILE IMAGE ICON */
.profile-img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    overflow: hidden;
    background: #ffffff;
    border: 2px solid #A855F7;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.25s ease;
}

.profile-img:hover {
    transform: scale(1.08);
    border-color: #C084FC;
}

.profile-img img {
    width: 65%;
    opacity: 0.8;
    transition: 0.25s ease;
}

.profile-img:hover img {
    opacity: 1;
}

/* NEW DROPDOWN STYLE — Card style */
.dropdown-menu {
    border-radius: 12px;
    padding: 12px 0;
    border: none;
    min-width: 260px;
    background: #ffffff;
    box-shadow: 0px 12px 28px rgba(0,0,0,0.22);
    animation: fadeDown 0.23s ease forwards;
    transform-origin: top right;
    opacity: 0;
}

@keyframes fadeDown {
    0% { opacity: 0; transform: translateY(-8px) scale(0.95); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}

/* Dropdown items */
.dropdown-item {
    padding: 11px 20px;
    font-size: 15px;
    border-radius: 8px;
    transition: 0.2s ease;
}

.dropdown-item:hover {
    background: #EDE9FE;
    color: #6D28D9;
}

.dropdown-item.text-danger:hover {
    background: #FEE2E2;
    color: #991B1B;
}

.dropdown-header {
    padding: 12px 22px;
    border-bottom: 1px solid #eee;
}
</style>

<!-- NAV CONTENT -->
<div class="menu">
    @guest
        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
        <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
    @endguest

    @auth
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Users</a>
        @endif

        <a href="{{ route('tanah.index') }}" class="{{ request()->routeIs('tanah.*') ? 'active' : '' }}">Tanah</a>
        <a href="{{ route('bangunan.index') }}" class="{{ request()->routeIs('bangunan.*') ? 'active' : '' }}">Bangunan</a>
        <a href="{{ route('ruangan.index') }}" class="{{ request()->routeIs('ruangan.*') ? 'active' : '' }}">Ruangan</a>
        <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">Kategori</a>
        <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">Barang</a>
    @endauth
</div>

@guest
    <a href="{{ route('login') }}" class="profile-img">
        <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png">
    </a>

@else
    <div class="dropdown">
        <button class="profile-img dropdown-toggle" data-bs-toggle="dropdown">
            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png">
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li class="dropdown-header">
                <strong>{{ Auth::user()->name }}</strong><br>
                <small class="text-muted">{{ Auth::user()->email }}</small>
            </li>

            <li>
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?');">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                </form>
            </li>
        </ul>
    </div>
@endguest

</nav>
