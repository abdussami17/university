@extends('layout.app')

@section('title', trans('general.Forum_University_Community'))

@section('content')
    <style>
        body {
            background: #f8f9fa;
        }
    </style>
    <style>
        main {
            margin-top: 0 !important;
        }
    </style>
    <div class="container">
        <h1 class="title">{{ trans('general.Forums') }}</h1>
        <div class="accordion" id="mainAccordion">



                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button " type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse">
                               Treffen List
                            </button>
                        </h2>
                        <div id="collapse"
                            class="accordion-collapse collapse show"
                            data-bs-parent="#mainAccordion">
                            <div class="accordion-body">
                                <div class="group-card">

        
                                            @foreach (App\Models\meet::where('parent_id', 0)->with('child')->get() as $category)


@php
    $slug = \Str::slug($category->name);
@endphp                                                <div class="card">
                                                    <img src="{{ asset($category->image) }}"
                                                        alt="{{ $category->name }}">
                                                    <div class="card-content">
                                                        <div class="card-title"
                                                            onclick="window.location='{{route('account.meet.category',$slug)}}'">
                                                            {!! $category->name !!}</div>
                                                        <div class="description">
                                                            {!! $category->description !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

            

        </div>
    </div>


@endsection
