@extends('layout.app')

@section('title', trans('Affiliate_Programs_Detail'))

@section('content')
<section class="detail-section container ">
    <div class="detail-upper-info">
        <div class="stars-area">
            <span data-testid="rating-stars" class="a455730030 d542f184f1" role="img"><span aria-hidden="true" class="fcd9eec8fb d31eda6efc c25361c37f"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50px"><path d="M23.555 8.729a1.505 1.505 0 0 0-1.406-.98h-6.087a.5.5 0 0 1-.472-.334l-2.185-6.193a1.5 1.5 0 0 0-2.81 0l-.005.016-2.18 6.177a.5.5 0 0 1-.471.334H1.85A1.5 1.5 0 0 0 .887 10.4l5.184 4.3a.5.5 0 0 1 .155.543l-2.178 6.531a1.5 1.5 0 0 0 2.31 1.684l5.346-3.92a.5.5 0 0 1 .591 0l5.344 3.919a1.5 1.5 0 0 0 2.312-1.683l-2.178-6.535a.5.5 0 0 1 .155-.543l5.194-4.306a1.5 1.5 0 0 0 .433-1.661"></path></svg></span><span aria-hidden="true" class="fcd9eec8fb d31eda6efc c25361c37f"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50px"><path d="M23.555 8.729a1.505 1.505 0 0 0-1.406-.98h-6.087a.5.5 0 0 1-.472-.334l-2.185-6.193a1.5 1.5 0 0 0-2.81 0l-.005.016-2.18 6.177a.5.5 0 0 1-.471.334H1.85A1.5 1.5 0 0 0 .887 10.4l5.184 4.3a.5.5 0 0 1 .155.543l-2.178 6.531a1.5 1.5 0 0 0 2.31 1.684l5.346-3.92a.5.5 0 0 1 .591 0l5.344 3.919a1.5 1.5 0 0 0 2.312-1.683l-2.178-6.535a.5.5 0 0 1 .155-.543l5.194-4.306a1.5 1.5 0 0 0 .433-1.661"></path></svg></span><span aria-hidden="true" class="fcd9eec8fb d31eda6efc c25361c37f"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50px"><path d="M23.555 8.729a1.505 1.505 0 0 0-1.406-.98h-6.087a.5.5 0 0 1-.472-.334l-2.185-6.193a1.5 1.5 0 0 0-2.81 0l-.005.016-2.18 6.177a.5.5 0 0 1-.471.334H1.85A1.5 1.5 0 0 0 .887 10.4l5.184 4.3a.5.5 0 0 1 .155.543l-2.178 6.531a1.5 1.5 0 0 0 2.31 1.684l5.346-3.92a.5.5 0 0 1 .591 0l5.344 3.919a1.5 1.5 0 0 0 2.312-1.683l-2.178-6.535a.5.5 0 0 1 .155-.543l5.194-4.306a1.5 1.5 0 0 0 .433-1.661"></path></svg></span><span aria-hidden="true" class="fcd9eec8fb d31eda6efc c25361c37f"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50px"><path d="M23.555 8.729a1.505 1.505 0 0 0-1.406-.98h-6.087a.5.5 0 0 1-.472-.334l-2.185-6.193a1.5 1.5 0 0 0-2.81 0l-.005.016-2.18 6.177a.5.5 0 0 1-.471.334H1.85A1.5 1.5 0 0 0 .887 10.4l5.184 4.3a.5.5 0 0 1 .155.543l-2.178 6.531a1.5 1.5 0 0 0 2.31 1.684l5.346-3.92a.5.5 0 0 1 .591 0l5.344 3.919a1.5 1.5 0 0 0 2.312-1.683l-2.178-6.535a.5.5 0 0 1 .155-.543l5.194-4.306a1.5 1.5 0 0 0 .433-1.661"></path></svg></span><span aria-hidden="true" class="fcd9eec8fb d31eda6efc c25361c37f"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50px"><path d="M23.555 8.729a1.505 1.505 0 0 0-1.406-.98h-6.087a.5.5 0 0 1-.472-.334l-2.185-6.193a1.5 1.5 0 0 0-2.81 0l-.005.016-2.18 6.177a.5.5 0 0 1-.471.334H1.85A1.5 1.5 0 0 0 .887 10.4l5.184 4.3a.5.5 0 0 1 .155.543l-2.178 6.531a1.5 1.5 0 0 0 2.31 1.684l5.346-3.92a.5.5 0 0 1 .591 0l5.344 3.919a1.5 1.5 0 0 0 2.312-1.683l-2.178-6.535a.5.5 0 0 1 .155-.543l5.194-4.306a1.5 1.5 0 0 0 .433-1.661"></path></svg></span></span>
        </div>
        <div class="title-area">
            <h2>{{$data->title}}</h2>
        </div>
    </div>
    <div class="main-image">
        <img alt="undefined undefined" class="product-card__hero-image css-1fxh5tw" height="100%" loading="eager" sizes="" src="{{ asset('Images/'.$data->poster) }}" width="100%">
    </div>
    <div class="detail-lower-info">
        
    <div class="reservation-container mt-5">
        <h3 class="title-header">
            {{ trans('general.Start_Learning_Now') }}
        </h3>
       <div class="body">
        <div class="part-1">
            <h6>{{ trans('general.Complete_Program') }}</h6>
            
            <b>{{ trans('general.Each_unit_has') }}:</b>
            <p>{{ trans('general.Lifetime_Access') }}</p>
            <ul>
                <li>
                    <i class="fa-solid fa-check"></i>
                    <span>{{ trans('general.Money_Back_Guarantee') }}</span>
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    <span>{{ trans('general.Free_Certification') }}</span>
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    <span>{{ trans('general.Online_Community') }}</span>
                </li>
            </ul>
        </div>
        <div class="part-2">
            <span>{{ trans('general.Online_Community') }}</span>
            <h6>{{ trans('general.Currency') }} {{$data->price}}</h6>
            <p>+{{ trans('general.Currency') }} 100.00 {{ trans('general.Taxes_Fees') }}</p>
            <a href="{{ route('account.enroll', ['module_type' => 'course', 'module_id' => $data->id]) }}">
                <button>{{ trans('general.Enroll_Now') }}</button>
            </a>
            
            
            <span class="text-center d-inline-block w-100">{{ trans('general.Dont_Worry') }}</span>
        </div>
       </div>
    </div>
    </div>
    
</section>
<div class="container reviews-section">
    <div class="title">
        <h4>{{ trans('general.Student_Reviews') }}</h4>
    </div>
    <div class="reviews-counter mt-3 d-flex justify-content-normal align-items-center gap-3">
        <div class="counter-box">
            <div>7.5</div>
        </div>
        <span><strong>{{ trans('general.Good') }}</strong>- 2,640 {{ trans('general.Reviews') }}</span>
    </div>
    <div class="review-container mt-4">
        <div class="review-box ">
            <div class="d-flex justify-content-between mb-1 align-items-center">
                <span>{{ trans('general.Content_Quality') }}</span>
                <span>7.9</span>
            </div>
            <div class="progress-bar">
                <span class="progress-bar-completion">

                </span>
            </div>
        </div>
        <div class="review-box ">
            <div class="d-flex justify-content-between mb-1 align-items-center">
                <span>{{ trans('general.Support') }}</span>
                <span>7.9</span>
            </div>
            <div class="progress-bar">
                <span class="progress-bar-completion">

                </span>
            </div>
        </div>
        <div class="review-box ">
            <div class="d-flex justify-content-between mb-1 align-items-center">
                <span>{{ trans('general.Practical_Assignments') }}</span>
                <span>7.9</span>
            </div>
            <div class="progress-bar">
                <span class="progress-bar-completion">

                </span>
            </div>
        </div>
        <div class="review-box ">
            <div class="d-flex justify-content-between mb-1 align-items-center">
                <span>{{ trans('general.Staff') }}</span>
                <span>7.9</span>
            </div>
            <div class="progress-bar">
                <span class="progress-bar-completion">

                </span>
            </div>
        </div>
        <div class="review-box ">
            <div class="d-flex justify-content-between mb-1 align-items-center">
                <span>{{ trans('general.Students') }}</span>
                <span>7.9</span>
            </div>
            <div class="progress-bar">
                <span class="progress-bar-completion">

                </span>
            </div>
        </div>
        <div class="review-box ">
            <div class="d-flex justify-content-between mb-1 align-items-center">
                <span>{{ trans('general.Courses') }}</span>
                <span>7.9</span>
            </div>
            <div class="progress-bar">
                <span class="progress-bar-completion">

                </span>
            </div>
        </div>
        <div class="review-box ">
            <div class="d-flex justify-content-between mb-1 align-items-center">
                <span>{{ trans('general.Staff') }}</span>
                <span>7.9</span>
            </div>
            <div class="progress-bar">
                <span class="progress-bar-completion">

                </span>
            </div>
        </div>
        <div class="review-box ">
            <div class="d-flex justify-content-between mb-1 align-items-center">
                <span>{{ trans('general.Staff') }}</span>
                <span>7.9</span>
            </div>
            <div class="progress-bar">
                <span class="progress-bar-completion">

                </span>
            </div>
        </div>
    </div>
</div>
<div class="container detail-lower-info mt-3">
    <div class="product_description">
    {!! $data->description !!}

        </div>
</div>
@endsection