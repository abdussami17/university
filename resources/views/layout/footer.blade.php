<footer class="footer-parent" style="background: var(--color-dark); color: var(--color-muted); padding: 3rem 0; margin-top: 0;">

    @php
    if (!function_exists('get_setting')) {
        function get_setting($key, $default = null, $lang = false)
        {
            $settings = Cache::remember('Setting', 2, function () {
                return App\Models\Setting::all();
            });
    
            if ($lang == false) {
                $setting = $settings->where('type', $key)->first();
            } else {
                $setting = $settings->where('type', $key)->where('lang', $lang)->first();
                $setting = !$setting ? $settings->where('type', $key)->first() : $setting;
            }
    
            return $setting == null ? $default : $setting->value;
        }
    }
    @endphp
    
    <div style="max-width:1400px; margin-inline:auto; padding-inline:1.5rem; display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:2rem;">
    
      <!-- LOGO + ABOUT -->
      <div>
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1rem;">
         <i style="color: var(--color-primary);height:30px;width:30px" data-lucide="graduation-cap"></i>
            <span style="font-family:var(--font-body);font-weight:800;font-size:1.4rem;color:#fff;">ProAISkill</span>
          </div>
        <p style="font-size:var(--fs-md);line-height:1.6;">
          The platform for ambitious students navigating career, skills and the AI economy.
        </p>
      </div>
    
      <!-- RESOURCES -->
      <div>
        <div style="font-family:var(--font-label);font-size:var(--fs-md);font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#fff;margin-bottom:.75rem;">
          {{ trans('general.Resources') }}
        </div>
    
        <ul style="display:flex;flex-direction:column;gap:.5rem;font-size:var(--fs-md);">
          <li>
            <a href="mailto:{{get_setting('website_email')}}" style="color:var(--color-muted);">
              {{get_setting('website_email')}}
            </a>
          </li>
          <li>
            <a href="tel:{{get_setting('website_phone')}}" style="color:var(--color-muted);">
              {{get_setting('website_phone')}}
            </a>
          </li>
          <li>
            <span>{{get_setting('website_address')}}</span>
          </li>
        </ul>
      </div>
    
      <!-- LINKS -->
      <div>
        <div style="font-family:var(--font-label);font-size:var(--fs-md);font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#fff;margin-bottom:.75rem;">
          {{ trans('general.Links') }}
        </div>
    
        <ul style="display:flex;flex-direction:column;gap:.5rem;font-size:var(--fs-md);">
          <li><a href="{{route('workshops')}}" style="color:var(--color-muted);">{{ trans('general.Workshops') }}</a></li>
          <li><a href="{{route('travel-mobility')}}" style="color:var(--color-muted);">{{ trans('general.Travel_Mobility') }}</a></li>
          <li><a href="{{route('affiliate-programs')}}" style="color:var(--color-muted);">{{ trans('general.Affiliate_Programs') }}</a></li>
          <li><a href="{{route('forum.web')}}" style="color:var(--color-muted);">{{ trans('general.Forum') }}</a></li>
          <li><a href="{{route('career.web')}}" style="color:var(--color-muted);">{{ trans('general.Career') }}</a></li>
          <li><a href="/" style="color:var(--color-muted);">{{ trans('general.AI_Integration') }}</a></li>
        </ul>
      </div>
    
      <!-- COMPANY (AUTH BASED) -->
      <div>
        <div style="font-family:var(--font-label);font-size:var(--fs-md);font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#fff;margin-bottom:.75rem;">
          {{ trans('general.Company') }}
        </div>
    
        <ul style="display:flex;flex-direction:column;gap:.5rem;font-size:var(--fs-md);">
          <li><a href="#" style="color:var(--color-muted);">{{ trans('general.Find_Discount') }}</a></li>
    
          @if(!auth()->check())
            <li><a href="{{ route('account.register') }}" style="color:var(--color-muted);">{{ trans('general.Join_Us') }}</a></li>
            <li><a href="{{ route('account.login') }}" style="color:var(--color-muted);">{{ trans('auth.sign_in') }}</a></li>
          @else
            <li><a href="{{ route('account.dashboard') }}" style="color:var(--color-muted);">{{ trans('general.Dashboard') }}</a></li>
            <li><a href="{{ route('account.logout') }}" style="color:var(--color-muted);">{{ trans('auth.logout') }}</a></li>
          @endif
        </ul>
      </div>
    
    </div>
    
    <!-- BOTTOM BAR -->
    <div style="max-width:1400px;margin-inline:auto;padding:1.5rem 1.5rem 0;border-top:1px solid #1e293b;margin-top:2rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
      
      <span style="font-size:var(--fs-md);">
        {!! get_setting('website_copyright') !!}
      </span>
    
      <span style="font-size:var(--fs-md);">
        Made for ambitious students worldwide.
      </span>
    
    </div>
    
    </footer>