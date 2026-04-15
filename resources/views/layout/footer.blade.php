<footer class="others-footer">
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
<div class="part-1">
<img src="{{asset('assets/Images/website.png')}}" height="40px" alt="t">
</div>

<div class="part-3">
    <div class="desktop-menu">
        <div class="menu-col">
            <h5>{{ trans('general.Resources') }}</h5>
<a href="mailto:{{get_setting('website_email')}}"><i class="fa-solid fa-envelope"></i> {{get_setting('website_email')}}</a>
<a href="tel:{{get_setting('website_phone')}}"><i class="fa-solid fa-phone"></i> {{get_setting('website_phone')}}</a>
<a href="javascript:void(0)"><i class="fa-solid fa-location-dot"></i> {{get_setting('website_address')}}</a>

        </div>
        <div class="menu-col">
            <h5>{{ trans('general.Links') }}</h5>
        <a href="{{route('workshops')}}">{{ trans('general.Workshops') }}</a>
        <a href="{{route('travel-mobility')}}" >{{ trans('general.Travel_Mobility') }}</a>
        <a href="{{route('affiliate-programs')}}">{{ trans('general.Affiliate_Programs') }}</a>
        <a href="{{route('forum.web')}}">{{ trans('general.Forum') }}</a>
        <a href="{{route('career.web')}}">{{ trans('general.Career') }}</a>
        <a href="/">{{ trans('general.AI_Integration') }}</a>
        </div>
        <div class="menu-col">
            <h5>{{ trans('general.Company') }}</h5>

        <a href="#">{{ trans('general.Find_Discount') }}</a>
        @if(!auth()->check())  

                <a href="{{ route('account.register') }}">
                    {{ trans('general.Join_Us') }}
                </a>

                <a href="{{ route('account.login') }}">
                    {{ trans('auth.sign_in') }}
                </a>

        @else

                <a href="{{ route('account.dashboard') }}">
                   {{ trans('general.Dashboard') }}
                </a>

                <a href="{{ route('account.logout') }}">
                    {{ trans('auth.logout') }}
                </a>

        @endif

        </div>
    </div>
</div>
<div class="part-4">
    <ul>
        <li>{!!get_setting('website_copyright')!!}</li>
    </ul>
</div>
</footer>