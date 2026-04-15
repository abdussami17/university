<header>
        <div class="top-header">
    <div class="part-1">
    </div>
    <div class="part-2">
    <nav>
        <ul>
            @if(!auth()->check())  
            <li>
                <a href="{{ route('account.register') }}">
                    <p>{{ trans('general.Join_Us') }}</p>
                </a>
                <div class="verticle-line"></div>
            </li>
            <li>
                <a href="{{ route('account.login') }}">
                    <p>{{ trans('auth.sign_in') }}</p>
                </a>
                <div class="verticle-line"></div>
            </li>
        @else
            <li>
                <a href="{{ route('account.dashboard') }}">
                    <p>{{ trans('general.Dashboard') }}</p>
                </a>
                <div class="verticle-line"></div>

            </li>
            <li>
                <a href="{{ route('account.logout') }}">
                    <p>{{ trans('auth.logout') }}</p>
                </a>
            </li>
        @endif
        
        </ul>
    </nav>
    </div>
        </div>
        <div class="main-header">
    <div class="part-1">
        <a aria-label="Nike Home Page" class="swoosh-link d-flex justify-content-normal align-items-center" data-testid="link" href="/">
            <img src="{{asset('assets/Images/website.png')}}" height="25px" alt="t">
        </a>
    </div>
    <div class="part-2">
    <nav>
        <ul>
            <li>
                <div>
                    <a href="{{route('workshops')}}">{{ trans('general.Workshops') }}</a>
                </div>
            </li>
            <li>
                <div>
                    <a href="{{route('travel-mobility')}}">{{ trans('general.Travel_Mobility') }}</a>
                </div>
            </li>
            <li>
                <div>
                    <a href="{{route('affiliate-programs')}}">{{ trans('general.Affiliate_Programs') }}</a>
                </div>
            </li>
            <li>
                <div>
                    <a href="{{route('forum.web')}}">{{ trans('general.Forum') }}</a>
                </div>
            </li>

            <li>
                <div>
                    <a href="{{route('career.web')}}">{{ trans('general.Career_Jobs') }}</a>
                </div>
            </li>

            <li>
                <div>
                    <a href="{{route('account.meet')}}">Treffen</a>
                </div>
            </li>
            
            <li>
                <div>
                    <a href="/">{{ trans('general.AI_Integration') }}</a>
                </div>
            </li>
            
        </ul>
    </nav>
    </div>
    <div class="part-3">
    <div class="user-tool-container">
        <search></search>
       
<button id="offcanvasToggle" aria-label="menu" type="button" class="nds-btn nds-button--icon-only mobile-btn css-dp3fdz ex41m6f0 btn-primary-light">
            <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none">
                <path stroke="currentColor" stroke-width="1.5" d="M21 5.25H3M21 12H3m18 6.75H3"></path></svg>
                <span class="ripple">
    
                </span>
            </button>
    </div>
    </div>
        </div>
    </header>