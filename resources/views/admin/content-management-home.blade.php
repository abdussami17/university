<head>
<style>
  .drop-area {
    border: 2px dashed #ccc;
    border-radius: 5px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .drop-area:hover {
    background-color: #f9f9f9;
  }
  .drop-area.drag-over {
    border-color: #007bff;
    background-color: #f1faff;
  }
  .drop-icon {
    font-size: 24px;
    color: #888;
    margin-bottom: 10px;
  }
  .drop-text {
    font-size: 16px;
    color: #555;
  }
  .preview-container img {
    max-height: 200px;
  }
</style>    
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script></head>
@extends('admin.app')
@section('title',trans('general.Content_Management_Home'))


@section('admin_content')

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


<div class="content">

<!-- Start Content-->
<div class="container-fluid">

 <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
     <div class="flex-grow-1">
         <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Home_Page') }}</h4>
     </div>

    
 </div>

 <!-- General Form -->
 <div class="row">
      
     <div class="col-12">
         <div class="card">

         

             <div class="card-body">
               <form action="{{route('content.update-home')}}" method="post" enctype="multipart/form-data">
@csrf
             
                 <div class="row">
                   <h5 class="content-title">{{ trans('general.Main_Banner') }}</h5>
                   <div class="mb-3">
                     <label for="email" class="form-label">{{ trans('general.Upload_Image') }}</label>
                    
                     <div class="drop-area">
@if(!empty($data->mainbanner))
    @php
        $fileExtension = pathinfo($data->mainbanner, PATHINFO_EXTENSION);
    @endphp

    <div class="preview-container">
        @if(in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg']))
            <video class="preview-video" autoplay loop muted style="max-width: 100%; height: 200px; display: block; margin: auto;">
                <source src="{{ asset($data->mainbanner) }}" type="video/{{ $fileExtension }}">
                Your browser does not support the video tag.
            </video>
        @elseif(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp','avif']))
            <img src="{{ asset($data->mainbanner) }}" alt="Banner Image" style="max-width: 100%; height: 200px; display: block; margin: auto;">
        @endif
    </div>
@else
    <div class="preview-container" style="display: none;">
        <!-- No preview -->
    </div>
@endif

                      <div class="upload-instructions">
                        <div class="drop-icon">
                          <i class="fa fa-upload" aria-hidden="true"></i>
                        </div>
                        <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
                      </div>
                      <input type="file" class="file-input" name="mainbanner"style="display: none;" />
                    </div>


              </div>
              <h5 class="mt-3 content-title">{{ trans('general.First_Section') }}</h5>
              <div class="mb-3 ">
                 <label class="form-label" >{{ trans('general.Title') }}</label><br>
               <input type="text" name="firstsection_title"  class="form-control" value="{{$data->firstsection_title}}">
                
              </div>
              <h6 class="box-title">{{ trans('general.Box_1') }}</h6>
              <div class="mb-3 position-relative">
                 <label class="form-label" >{{ trans('general.Title') }}</label>
                 <input name="firstsection_box1_title" type="text" class="form-control" value="{{$data->firstsection_box1_title}}">
              </div>
              <div class="mb-3 position-relative">
                 <label class="form-label" >{{ trans('general.Description') }}</label>
                 <textarea  id="texteditor1" name="firstsection_box1_description" cols="30" rows="10" >{{$data->firstsection_box1_description}}</textarea>
              </div>
              <div class="mb-3 position-relative">
                 <label class="form-label" >{{ trans('general.Image') }}</label><br>
                 <div class="drop-area">
                      @if(!empty($data->firstsection_box1_image))
                      <div class="preview-container">
                        <img class="preview-image" src="{{ asset($data->firstsection_box1_image) }}" alt="Preview"
                          style="max-width: 100%; height: auto; display: block; margin: auto;" />
                      </div>
                      @else
                      <div class="preview-container" style="display: none;">
                        <img class="preview-image" src="#" alt="Preview"
                          style="max-width: 100%; height: auto; display: block; margin: auto;" />
                      </div>
                      @endif
                      <div class="upload-instructions">
                        <div class="drop-icon">
                          <i class="fa fa-upload" aria-hidden="true"></i>
                        </div>
                        <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
                      </div>
                      <input type="file" class="file-input" name="firstsection_box1_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
                    </div>
             </div>

             <h6 class="box-title">{{ trans('general.Box_2') }}</h6>
             <div class="mb-3 position-relative">
                <label class="form-label" >{{ trans('general.Title') }}</label>
                <input name="firstsection_box2_title" type="text" class="form-control" value="{{$data->firstsection_box2_title}}">
             </div>
             <div class="mb-3 position-relative">
                <label class="form-label" >{{ trans('general.Description') }}</label>
                <textarea name="firstsection_box2_description"  id="texteditor2" cols="30" rows="10" >{{$data->firstsection_box2_description}}</textarea>
             </div>
             <div class="mb-3 position-relative">
                <label class="form-label" >{{ trans('general.Image') }}</label><br>
                <div class="drop-area">
                @if(!empty($data->firstsection_box2_image))
                <div class="preview-container">
                  <img class="preview-image" src="{{ asset( $data->firstsection_box2_image) }}" alt="Preview"
                    style="max-width: 100%; height: auto; display: block; margin: auto;" />
                </div>
                @else
                <div class="preview-container" style="display: none;">
                  <img class="preview-image" src="#" alt="Preview"
                    style="max-width: 100%; height: auto; display: block; margin: auto;" />
                </div>
                @endif
                <div class="upload-instructions">
                  <div class="drop-icon">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                  </div>
                  <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
                </div>
                <input type="file" class="file-input" name="firstsection_box2_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
              </div>
            </div>


            <h6 class="box-title">{{ trans('general.Box_3') }}</h6>
            <div class="mb-3 position-relative">
               <label class="form-label" >{{ trans('general.Title') }}</label>
               <input name="firstsection_box3_title" type="text" class="form-control" value="{{$data->firstsection_box3_title}}">
            </div>
            <div class="mb-3 position-relative">
               <label class="form-label" >{{ trans('general.Description') }}</label>
               <textarea name="firstsection_box3_description"   id="texteditor3" cols="30" rows="10" >{{$data->firstsection_box3_description}}</textarea>
            </div>
            <div class="mb-3 position-relative">
               <label class="form-label" >{{ trans('general.Image') }}</label><br>
               <div class="drop-area">
                    @if(!empty($data->firstsection_box3_image))
                    <div class="preview-container">
                      <img class="preview-image" src="{{ asset( $data->firstsection_box3_image) }}" alt="Preview"
                        style="max-width: 100%; height: auto; display: block; margin: auto;" />
                    </div>
                    @else
                    <div class="preview-container" style="display: none;">
                      <img class="preview-image" src="#" alt="Preview"
                        style="max-width: 100%; height: auto; display: block; margin: auto;" />
                    </div>
                    @endif
                    <div class="upload-instructions">
                      <div class="drop-icon">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                      </div>
                      <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
                    </div>
                    <input type="file" class="file-input" name="firstsection_box3_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
                  </div>
           </div>



           <h5 class="mt-3 content-title">{{ trans('general.Second_Section') }}</h5>
           <div class="mb-3 ">
              <label class="form-label" >{{ trans('general.Title') }}</label><br>
            <input name="secondsection_title" type="text" class="form-control" value="{{$data->secondsection_title}}">
             
           </div>
           <h6 class="box-title">{{ trans('general.Box_1') }}</h6>
           <div class="mb-3 position-relative">
              <label class="form-label" >{{ trans('general.Title') }}</label>
              <input name="secondsection_box1_title" type="text" class="form-control" value="{{$data->secondsection_box1_title}}">
           </div>
           <div class="mb-3 position-relative">
              <label class="form-label" >{{ trans('general.Description') }}</label>
              <textarea  id="texteditor4" cols="30" name="secondsection_box1_description" rows="10" >{{$data->secondsection_box1_description}}</textarea>
           </div>
           <div class="mb-3 position-relative">
              <label class="form-label" >{{ trans('general.Image') }}</label><br>
              <div class="drop-area">
              @if(!empty($data->secondsection_box1_image))
              <div class="preview-container">
                <img class="preview-image" src="{{ asset( $data->secondsection_box1_image) }}" alt="Preview"
                  style="max-width: 100%; height: auto; display: block; margin: auto;" />
              </div>
              @else
              <div class="preview-container" style="display: none;">
                <img class="preview-image" src="#" alt="Preview"
                  style="max-width: 100%; height: auto; display: block; margin: auto;" />
              </div>
              @endif
              <div class="upload-instructions">
                <div class="drop-icon">
                  <i class="fa fa-upload" aria-hidden="true"></i>
                </div>
                <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
              </div>
              <input type="file" class="file-input" name="secondsection_box1_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
            </div>
          </div>

          <h6 class="box-title">{{ trans('general.Box_2') }}</h6>
          <div class="mb-3 position-relative">
             <label class="form-label" >{{ trans('general.Title') }}</label>
             <input name="secondsection_box2_title" type="text" class="form-control" value="{{ $data['secondsection_box2_title'] }}">

          </div>
          <div class="mb-3 position-relative">
             <label class="form-label" >{{ trans('general.Description') }}</label>
             <textarea name="secondsection_box2_description"  id="texteditor5" cols="30" rows="10" >{{$data->secondsection_box2_description}}</textarea>
          </div>
         {{-- <div class="mb-3 position-relative">
             <label class="form-label" >{{ trans('general.Image') }}</label><br>
             <div class="drop-area">
              @if(!empty($data->secondsection_box2_image))
              <div class="preview-container">
                <img class="preview-image" src="{{ asset( $data->secondsection_box2_image) }}" alt="Preview"
                  style="max-width: 100%; height: auto; display: block; margin: auto;" />
              </div>
              @else
              <div class="preview-container" style="display: none;">
                <img class="preview-image" src="#" alt="Preview"
                  style="max-width: 100%; height: auto; display: block; margin: auto;" />
              </div>
              @endif
              <div class="upload-instructions">
                <div class="drop-icon">
                  <i class="fa fa-upload" aria-hidden="true"></i>
                </div>
                <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
              </div>
              <input type="file" class="file-input" name="secondsection_box2_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
            </div>
         </div>--}}


         <h6 class="box-title">{{ trans('general.Box_3') }}</h6>
         <div class="mb-3 position-relative">
            <label class="form-label" >{{ trans('general.Title') }}</label>
            <input name="secondsection_box3_title" type="text" class="form-control" value="{{$data->secondsection_box3_title}}">
         </div>
         <div class="mb-3 position-relative">
            <label class="form-label" >{{ trans('general.Description') }}</label>
            <textarea name="secondsection_box3_description"  id="texteditor6" cols="30" rows="10" >{{$data->secondsection_box3_description}}</textarea>
         </div>
         {{--<div class="mb-3 position-relative">
            <label class="form-label" >{{ trans('general.Image') }}</label><br>
            <div class="drop-area">
              @if(!empty($data->secondsection_box3_image))
              <div class="preview-container">
                <img class="preview-image" src="{{ asset( $data->secondsection_box3_image) }}" alt="Preview"
                  style="max-width: 100%; height: auto; display: block; margin: auto;" />
              </div>
              @else
              <div class="preview-container" style="display: none;">
                <img class="preview-image" src="#" alt="Preview"
                  style="max-width: 100%; height: auto; display: block; margin: auto;" />
              </div>
              @endif
              <div class="upload-instructions">
                <div class="drop-icon">
                  <i class="fa fa-upload" aria-hidden="true"></i>
                </div>
                <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
              </div>
              <input type="file" class="file-input" name="secondsection_box3_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
            </div>
        </div>--}}


        <h5 class="mt-3 content-title">{{ trans('general.Third_Section') }}</h5>
      <div class="mb-3 ">
         <label class="form-label" >{{ trans('general.Title') }}</label><br>
       <input name="thirdsection_title" type="text" class="form-control" value="{{$data->thirdsection_title}}">
        
      </div>
      <h6 class="box-title">{{ trans('general.Box_1') }}</h6>
      <div class="mb-3 position-relative">
         <label class="form-label" >{{ trans('general.Title') }}</label>
         <input name="thirdsection_box1_title" type="text" class="form-control" value="{{$data->thirdsection_box1_title}}">
      </div>
      <div class="mb-3 position-relative">
         <label class="form-label" >{{ trans('general.Description') }}</label>
         <textarea name="thirdsection_box1_description"  id="texteditor11" cols="30" rows="10" >{{$data->thirdsection_box1_description}}</textarea>
      </div>
      <div class="mb-3 position-relative">
         <label class="form-label" >{{ trans('general.Image') }}</label><br>
         <div class="drop-area">
          @if(!empty($data->thirdsection_box1_image))
          <div class="preview-container">
            <img class="preview-image" src="{{ asset( $data->thirdsection_box1_image) }}" alt="Preview"
              style="max-width: 100%; height: auto; display: block; margin: auto;" />
          </div>
          @else
          <div class="preview-container" style="display: none;">
            <img class="preview-image" src="#" alt="Preview"
              style="max-width: 100%; height: auto; display: block; margin: auto;" />
          </div>
          @endif
          <div class="upload-instructions">
            <div class="drop-icon">
              <i class="fa fa-upload" aria-hidden="true"></i>
            </div>
            <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
          </div>
          <input type="file" class="file-input" name="thirdsection_box1_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
        </div>
     </div>

     <h6 class="box-title">{{ trans('general.Box_2') }}</h6>
     <div class="mb-3 position-relative">
        <label class="form-label" >{{ trans('general.Title') }}</label>
        <input name="thirdsection_box2_title" type="text" class="form-control" value="{{$data->thirdsection_box2_title}}">
     </div>
     <div class="mb-3 position-relative">
        <label class="form-label" >{{ trans('general.Description') }}</label>
        <textarea  name="thirdsection_box2_description" id="texteditor12" cols="30" rows="10" >{{$data->thirdsection_box2_description}}</textarea>
     </div>
     {{--<div class="mb-3 position-relative">
        <label class="form-label" >{{ trans('general.Image') }}</label><br>
        <div class="drop-area">
        @if(!empty($data->thirdsection_box2_image))
        <div class="preview-container">
          <img class="preview-image" src="{{ asset( $data->thirdsection_box2_image) }}" alt="Preview"
            style="max-width: 100%; height: auto; display: block; margin: auto;" />
        </div>
        @else
        <div class="preview-container" style="display: none;">
          <img class="preview-image" src="#" alt="Preview"
            style="max-width: 100%; height: auto; display: block; margin: auto;" />
        </div>
        @endif
        <div class="upload-instructions">
          <div class="drop-icon">
            <i class="fa fa-upload" aria-hidden="true"></i>
          </div>
          <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
        </div>
        <input type="file" class="file-input" name="thirdsection_box2_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
      </div>
    </div>--}}


    <h6 class="box-title">{{ trans('general.Box_3') }}</h6>
    <div class="mb-3 position-relative">
       <label class="form-label" >{{ trans('general.Title') }}</label>
       <input name="thirdsection_box3_title" type="text" class="form-control" value="{{$data->thirdsection_box3_title}}">
    </div>
    <div class="mb-3 position-relative">
       <label class="form-label" >{{ trans('general.Description') }}</label>
       <textarea name="thirdsection_box3_description"  id="texteditor13" cols="30" rows="10" >{{$data->thirdsection_box3_description}}</textarea>
    </div>
   {{-- <div class="mb-3 position-relative">
       <label class="form-label" >{{ trans('general.Image') }}</label><br>
       <div class="drop-area">
        @if(!empty($data->thirdsection_box3_image))
        <div class="preview-container">
          <img class="preview-image" src="{{ asset( $data->thirdsection_box3_image) }}" alt="Preview"
            style="max-width: 100%; height: auto; display: block; margin: auto;" />
        </div>
        @else
        <div class="preview-container" style="display: none;">
          <img class="preview-image" src="#" alt="Preview"
            style="max-width: 100%; height: auto; display: block; margin: auto;" />
        </div>
        @endif
        <div class="upload-instructions">
          <div class="drop-icon">
            <i class="fa fa-upload" aria-hidden="true"></i>
          </div>
          <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
        </div>
        <input type="file" class="file-input" name="thirdsection_box3_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
      </div>
   </div>--}}




      
      <h5 class="mt-3 content-title">{{ trans('general.Last_Section') }}</h5>
      <div class="mb-3 ">
         <label class="form-label" >{{ trans('general.Title') }}</label><br>
       <input name="lastsection_title" type="text" class="form-control" value="{{$data->lastsection_title}}">
        
      </div>
      <h6 class="box-title">{{ trans('general.Box_1') }}</h6>
      <div class="mb-3 position-relative">
         <label class="form-label" >{{ trans('general.Title') }}</label>
         <input name="lastsection_box1_title" type="text" class="form-control" value="{{$data->lastsection_box1_title}}">
      </div>
      <div class="mb-3 position-relative">
         <label class="form-label" >{{ trans('general.Description') }}</label>
         <textarea name="lastsection_box1_description"  id="texteditor20" cols="30" rows="10" >{{$data->lastsection_box1_description}}</textarea>
      </div>
      {{--<div class="mb-3 position-relative">
         <label class="form-label" >{{ trans('general.Image') }}</label><br>
         <div class="drop-area">
        @if(!empty($data->lastsection_box1_image))
        <div class="preview-container">
          <img class="preview-image" src="{{ asset( $data->lastsection_box1_image) }}" alt="Preview"
            style="max-width: 100%; height: auto; display: block; margin: auto;" />
        </div>
        @else
        <div class="preview-container" style="display: none;">
          <img class="preview-image" src="#" alt="Preview"
            style="max-width: 100%; height: auto; display: block; margin: auto;" />
        </div>
        @endif
        <div class="upload-instructions">
          <div class="drop-icon">
            <i class="fa fa-upload" aria-hidden="true"></i>
          </div>
          <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
        </div>
        <input type="file" class="file-input" name="lastsection_box1_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
      </div>
     </div>--}}

     <h6 class="box-title">{{ trans('general.Box_2') }}</h6>
     <div class="mb-3 position-relative">
        <label class="form-label" >{{ trans('general.Title') }}</label>
        <input name="lastsection_box2_title" type="text" class="form-control" value="{{$data->lastsection_box2_title}}">
     </div>
     <div class="mb-3 position-relative">
        <label class="form-label" >{{ trans('general.Description') }}</label>
        <textarea name="lastsection_box2_description"  id="texteditor21" cols="30" rows="10" >{{$data->lastsection_box2_description}}</textarea>
     </div>
{{--     <div class="mb-3 position-relative">
        <label class="form-label" >{{ trans('general.Image') }}</label><br>
        <div class="drop-area">
          @if(!empty($data->lastsection_box2_image))
          <div class="preview-container">
            <img class="preview-image" src="{{ asset( $data->lastsection_box2_image) }}" alt="Preview"
              style="max-width: 100%; height: auto; display: block; margin: auto;" />
          </div>
          @else
          <div class="preview-container" style="display: none;">
            <img class="preview-image" src="#" alt="Preview"
              style="max-width: 100%; height: auto; display: block; margin: auto;" />
          </div>
          @endif
          <div class="upload-instructions">
            <div class="drop-icon">
              <i class="fa fa-upload" aria-hidden="true"></i>
            </div>
            <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
          </div>
          <input type="file" class="file-input" name="lastsection_box2_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
        </div>
    </div>--}}


    <h6 class="box-title">{{ trans('general.Box_3') }}</h6>
    <div class="mb-3 position-relative">
       <label class="form-label" >{{ trans('general.Title') }}</label>
       <input name="lastsection_box3_title" type="text" class="form-control" value="{{$data->lastsection_box3_title}}">
    </div>
    <div class="mb-3 position-relative">
       <label class="form-label" >{{ trans('general.Description') }}</label>
       <textarea name="lastsection_box3_description"  id="texteditor22" cols="30" rows="10" >{{$data->lastsection_box3_description}}</textarea>
    </div>
   {{-- <div class="mb-3 position-relative">
       <label class="form-label" >{{ trans('general.Image') }}</label><br>
       <div class="drop-area">
        @if(!empty($data->lastsection_box3_image))
        <div class="preview-container">
          <img class="preview-image" src="{{ asset( $data->lastsection_box3_image) }}" alt="Preview"
            style="max-width: 100%; height: auto; display: block; margin: auto;" />
        </div>
        @else
        <div class="preview-container" style="display: none;">
          <img class="preview-image" src="#" alt="Preview"
            style="max-width: 100%; height: auto; display: block; margin: auto;" />
        </div>
        @endif
        <div class="upload-instructions">
          <div class="drop-icon">
            <i class="fa fa-upload" aria-hidden="true"></i>
          </div>
          <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
        </div>
        <input type="file" class="file-input" name="lastsection_box3_image" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
      </div>
   </div>--}}

  
                 </div>
                 <div class="d-flex justify-content-end">
                               <button type="submit" class="btn btn-primary me-2">{{ trans('general.Save') }}</button>
                               <button type="button" onclick="window.location='{{route('admin.content-management')}}'" class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Cancel') }}</button>
                             </div>
                             </form>
             </div>

         </div>
     </div>
 </div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('general.setting.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    


    @for ($i = 1; $i <= 3; $i++)
        <h4>{{trans('general.Testimonial')}} {{ $i }}</h4>

        <label class="form-label">{{ trans('general.testimonial_title') }}</label>
        <input type="hidden" name="types[]" value="testimonial{{ $i }}_title">
        <input type="text" name="testimonial{{ $i }}_title" value="{{ get_setting('testimonial'.$i.'_title') }}" class="form-control">
        <br>

        <label class="form-label">{{ trans('general.testimonial_description') }}</label>
        <input type="hidden" name="types[]" value="testimonial{{ $i }}_description">
        <input type="text" name="testimonial{{ $i }}_description" value="{{ get_setting('testimonial'.$i.'_description') }}" class="form-control">
        <br>

        <label class="form-label">{{ trans('general.testimonial_designation') }}</label>
        <input type="hidden" name="types[]" value="testimonial{{ $i }}_designation">
        <input type="text" name="testimonial{{ $i }}_designation" value="{{ get_setting('testimonial'.$i.'_designation') }}" class="form-control">
        <br>

        <!-- Testimonial Image -->
    <!-- header_logo -->
    <input type="hidden" name="types[]" value="header_logo{{ $i }}">
    <input type="hidden" name="header_logo{{ $i }}" value="{{ get_setting('header_logo'.$i) }}">
    <input class="form-control" type="file" name="header_logo{{ $i }}" placeholder="header_logo">
    



        @php
            $testimonialImage = get_setting('header_logo'.$i);
        @endphp
        @if ($testimonialImage)
            <div class="thumb-container">
                <img src="{{ asset('website/websitedata/' . $testimonialImage) }}" class="img-thumbnail mt-2" width="100px" height="100px">
            </div>
        @endif

        <br><hr>
    @endfor
    
<hr>
        <label class="form-label">{{ trans('general.footer') }}</label>
            <input type="hidden" name="types[]" value="frontend_footer">
        <textarea id="summernote" class="form-control" name="frontend_footer">{{get_setting('frontend_footer')}}</textarea>


    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary me-2">{{ trans('general.Save') }}</button>
        <button type="button" onclick="window.location='{{route('admin.content-management')}}'" class="btn btn-light">{{ trans('general.Cancel') }}</button>
    </div>
</form>

    </div>
</div>

</div>
 
</div> <!-- container-fluid -->
</div>
<script>
            ClassicEditor
               .create( document.querySelector( '#texteditor1' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor2' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor3' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor4' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor5' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor6' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor7' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor8' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor9' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor10' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor11' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor12' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor13' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor20' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor21' ) )
               .catch( error => {
                   console.error( error );
               });
               ClassicEditor
               .create( document.querySelector( '#texteditor22' ) )
               .catch( error => {
                   console.error( error );
               });
    function openfile(){
        document.querySelector('#upload-banner').click();
    }
</script>

<script>
document.querySelectorAll(".drop-area").forEach((dropArea) => {
  const fileInput = dropArea.querySelector(".file-input");
  const previewContainer = dropArea.querySelector(".preview-container");
  const previewImage = dropArea.querySelector(".preview-image");
  const previewVideo = dropArea.querySelector(".preview-video source");
  const uploadInstructions = dropArea.querySelector(".upload-instructions");

  dropArea.addEventListener("click", () => fileInput.click());

  dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropArea.classList.add("drag-over");
  });

  dropArea.addEventListener("dragleave", () => dropArea.classList.remove("drag-over"));

  dropArea.addEventListener("drop", (e) => {
    e.preventDefault();
    dropArea.classList.remove("drag-over");

    const file = e.dataTransfer.files[0];
    handleFileUpload(file, fileInput, previewImage, previewVideo, previewContainer, uploadInstructions);
  });

  fileInput.addEventListener("change", () => {
    const file = fileInput.files[0];
    handleFileUpload(file, fileInput, previewImage, previewVideo, previewContainer, uploadInstructions);
  });
});

function handleFileUpload(file, fileInput, previewImage, previewVideo, previewContainer, uploadInstructions) {
  const inputName = fileInput.getAttribute("name");

if (inputName === "mainbanner") {
    if (validateImage(file)) {
      displayImagePreview(file, previewImage, previewContainer, uploadInstructions);
    } else if (validateVideo(file)) {
      displayVideoPreview(file, previewVideo, previewContainer, uploadInstructions);
    } else {
      alert("{{ trans('general.invalid_file_type') }}");
      fileInput.value = "";
    }
} else {
    if (validateImage(file)) {
      displayImagePreview(file, previewImage, previewContainer, uploadInstructions);
    } else if (validateVideo(file)) {
      displayVideoPreview(file, previewVideo, previewContainer, uploadInstructions);
    } else {
      alert("{{ trans('general.invalid_file_type') }}");
      fileInput.value = "";
    }
}

}

function validateImage(file) {
  const allowedImageTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp"];
  return file && allowedImageTypes.includes(file.type);
}

function validateVideo(file) {
  const allowedVideoTypes = ["video/mp4", "video/webm", "video/ogg"];
  return file && allowedVideoTypes.includes(file.type);
}

function displayImagePreview(file, previewImage, previewContainer, uploadInstructions) {
  const reader = new FileReader();
  reader.onload = (e) => {
    previewImage.src = e.target.result;
    previewImage.style.display = "block";
    previewImage.parentElement.querySelector("video").style.display = "none";
    previewContainer.style.display = "block";
    uploadInstructions.style.display = "none";
  };
  reader.readAsDataURL(file);
}

function displayVideoPreview(file, previewVideo, previewContainer, uploadInstructions) {
  const reader = new FileReader();
  reader.onload = (e) => {
    previewVideo.src = e.target.result;
    previewVideo.parentElement.style.display = "block";
    previewVideo.parentElement.load();
    previewVideo.parentElement.parentElement.querySelector("img").style.display = "none";
    previewContainer.style.display = "block";
    uploadInstructions.style.display = "none";
  };
  reader.readAsDataURL(file);
}
</script>


@endsection