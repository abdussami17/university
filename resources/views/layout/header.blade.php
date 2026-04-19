
    <header class="navbar" role="banner">
        <div class="navbar__inner">
    
          <!-- Left: Search + User -->
          <div class="navbar__icons">
    
            <!-- Search icon -->
            <button class="navbar__icon-btn" id="navbar-search-trigger" aria-label="Search">
              <i data-lucide="search"></i>
            </button>
          
            <!-- Profile icon + dropdown -->
            <div class="navbar__profile-dropdown-wrapper">
              <button class="navbar__icon-btn" id="navbar-profile-trigger" aria-label="Account" aria-expanded="false" aria-haspopup="true">
                <i data-lucide="user"></i>
              </button>
          
              <div class="navbar__profile-dropdown" id="navbar-profile-dropdown" role="menu">

                <!-- Nav items -->
                <nav class="navbar__profile-dropdown-nav">
                    @if(!auth()->check()) 
                
                    <a href="{{ route('account.register') }}" class="navbar__profile-dropdown-item d-flex align-items-center gap-2" role="menuitem">
                        <i data-lucide="user-plus"></i>
                        <span>{{ trans('auth.register') }}</span>
                    </a>
                
                    <a href="{{ route('account.login') }}" class="navbar__profile-dropdown-item d-flex align-items-center gap-2" role="menuitem">
                        <i data-lucide="log-in"></i>
                        <span>{{ trans('auth.sign_in') }}</span>
                    </a>
                
                    @else
                
                    <a href="{{ route('account.dashboard') }}" class="navbar__profile-dropdown-item d-flex align-items-center gap-2" role="menuitem">
                        <i data-lucide="layout-dashboard"></i>
                        <span>{{ trans('general.Dashboard') }}</span>
                    </a>
                
                    <a href="{{ route('account.logout') }}" class="navbar__profile-dropdown-item d-flex align-items-center gap-2" role="menuitem">
                        <i data-lucide="log-out"></i>
                        <span>{{ trans('auth.logout') }}</span>
                    </a>
                
                    @endif
                </nav>
              </div>
            </div>
          
          </div>
          
          <!-- Search overlay (backdrop) -->
          <div class="navbar__search-overlay" id="navbar-search-overlay"></div>
          
          <!-- Search popup (slides from top) -->
          <div class="navbar__search-popup" id="navbar-search-popup" role="dialog" aria-label="Search">
            <div class="navbar__search-popup-inner">
              <svg class="navbar__search-popup-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
              <input
                type="text"
                class="navbar__search-popup-input"
                id="navbar-search-input"
                placeholder="Search..."
                autocomplete="off"
              />
              <button class="navbar__search-popup-close" id="navbar-search-close" aria-label="Close search">ESC</button>
            </div>
          </div>
    
          <!-- Center: Logo -->
          <a href="/" class="navbar__logo" aria-label="ProAISkill Home">
            <i data-lucide="graduation-cap"></i>
            <span class="navbar__logo-text">ProAISkill</span>
          </a>
    
    
    
          <!-- Hamburger (mobile) -->
          <button class="navbar__hamburger" aria-label="Toggle menu" aria-expanded="false">
            <span></span><span></span><span></span>
          </button>
        </div>
        <div class="header-2">
                <!-- Center: Nav -->
                <nav class="navbar__nav" role="navigation" aria-label="Main Navigation">
                  <ul class="navbar__nav-list">
                
                    <li class="navbar__nav-item {{ request()->routeIs('workshops') ? 'active' : '' }}">
                      <a href="{{ route('workshops') }}">{{ trans('general.Workshops') }}</a>
                    </li>
                
                    <li class="navbar__nav-item {{ request()->routeIs('travel-mobility') ? 'active' : '' }}">
                      <a href="{{ route('travel-mobility') }}">{{ trans('general.Travel_Mobility') }}</a>
                    </li>
                
                    <li class="navbar__nav-item {{ request()->routeIs('affiliate-programs') ? 'active' : '' }}">
                      <a href="{{ route('affiliate-programs') }}">{{ trans('general.Affiliate_Programs') }}</a>
                    </li>
                
                    <li class="navbar__nav-item {{ request()->routeIs('forum.web') ? 'active' : '' }}">
                      <a href="{{ route('forum.web') }}">{{ trans('general.Forum') }}</a>
                    </li>
                
                    <li class="navbar__nav-item {{ request()->routeIs('career.web') ? 'active' : '' }}">
                      <a href="{{ route('career.web') }}">{{ trans('general.Career_Jobs') }}</a>
                    </li>
                
                    <li class="navbar__nav-item {{ request()->routeIs('account.meet') ? 'active' : '' }}">
                      <a href="{{ route('account.meet') }}">Treffen</a>
                    </li>
                
                    <li class="navbar__nav-item {{ request()->is('/') ? 'active' : '' }}">
                      <a href="/">{{ trans('general.AI_Integration') }}</a>
                    </li>
                
                  </ul>
                </nav>
          
        </div>
      </header>
    
    
      <!-- Mobile Menu -->
      <nav class="mobile-menu" role="navigation" aria-label="Mobile Navigation">
        <ul>
 
            <li class="mobile-menu__item"><a href="{{route('workshops')}}">{{ trans('general.Workshops') }}</a></li>
            <li class="mobile-menu__item"><a href="{{route('travel-mobility')}}">{{ trans('general.Travel_Mobility') }}</a></li>
            <li class="mobile-menu__item"><a href="{{route('affiliate-programs')}}">{{ trans('general.Affiliate_Programs') }}</a></li>
            <li class="mobile-menu__item"><a href="{{route('forum.web')}}">{{ trans('general.Forum') }}</a></li>
            <li class="mobile-menu__item"><a href="{{route('career.web')}}">{{ trans('general.Career_Jobs') }}</a></li>
            <li class="mobile-menu__item"><a href="{{ route('account.meet')}}">Treffen</a></li>
            <li class="mobile-menu__item"><a href="/">{{ trans('general.AI_Integration') }}</a></li>
        </ul>
      </nav>