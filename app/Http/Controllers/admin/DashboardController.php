<?php

namespace App\Http\Controllers\admin;

use App\Models\AffliatePrograms;
use App\Models\Appointments;
use App\Models\homeContent;
use App\Models\TravelMobility;
use App\Models\TravelMobilityCategories;
use App\Models\User;
use App\Models\Workshops;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class DashboardController extends Controller
{
    //This method will show dashboard for admin


  public function index(){
      $users = User::count();
      $Affiliate = AffliatePrograms::count();
      $Workshops = Workshops::count();
      $travel = TravelMobility::count();
      $appointments = Appointments::all();

        return view('admin.dashboard',compact('users','Affiliate','Workshops','travel','appointments'));
  }

  public function document()
  {
    return view('admin.document');
  }
  public function userManagement(){
    $data = User::all()->where('status','active');
    return view('admin.user-management',compact('data'));
  }
  public function ai(){
    return view('admin.ai');
  }
  public function deleteUser($id) {
      $user = User::findOrFail($id);
      $user->delete();
      
      return redirect()->route('admin.user-management')->with('success', __('messages.user.deleted'));
  }
  public function deleteWorkshop($id) {
      $user = Workshops::findOrFail($id);

        if (!empty($user->poster)) {
           
            $oldFilePath = public_path('Images/' . basename($user->poster));
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        
      $user->delete();
      
      return redirect()->route('admin.workshops')->with('success', __('messages.workshop.deleted'));
  }
  public function deleteAffiliate($id) {
      $user = AffliatePrograms::findOrFail($id);
      
        if (!empty($user->poster)) {
           
            $oldFilePath = public_path('Images/' . basename($user->poster));
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

      $user->delete();
      
      return redirect()->route('admin.affiliate-programs')->with('success', __('messages.affiliate-program.deleted'));
  }
  public function contentManagement(){
    return view('admin.content-management');
  }
  public function Workshops(){

    $data = Workshops::all();
    return view('admin.workshops',compact('data'));
  }
  public function AffiliatePrograms(){
    $data = AffliatePrograms::all();
    return view('admin.affiliate-programs',compact('data'));
  }
  public function TravelMobility(){
    
    $data = TravelMobility::all();
    return view('admin.travel-mobility' , compact('data'));
  }

  public function deleteTravelMobility($id){
    $user = TravelMobility::findOrFail($id);
            if (!empty($user->poster)) {
           
            $oldFilePath = public_path('Images/' . basename($user->poster));
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        
      $user->delete();
      
      return redirect()->route('admin.travel-mobility')->with('success', __('messages.travel-mobility.deleted'));
  }


  public function addWorkshops(Request $request){
      $data = new Workshops();
      $data->title = $request->title;
      $data->description = $request->description;
      $data->status = "active";
      $data->card_description = $request->card_description;
      $data->price = $request->price;
      if ($request->hasFile('poster')) {
        $file = $request->file('poster');
        $ext = $file->getClientOriginalExtension();
        $filename = rand().'.'.$ext;
        $file->move('Images',$filename);
        $data->poster = $filename;
      }else{
        $data->poster = "null";

      }
      $data->save();
      return redirect()->back()->with('success', __('messages.workshop.created'));
  }
  public function addAffiliate(Request $request){
    $data = new AffliatePrograms();
    $data->title = $request->title;
    $data->description = $request->description;
    $data->status = "active";
    $data->card_description = $request->card_description;
    $data->price = $request->price;
    if ($request->hasFile('poster')) {
      $file = $request->file('poster');
      $ext = $file->getClientOriginalExtension();
      $filename = rand().'.'.$ext;
      $file->move('Images',$filename);
      $data->poster = $filename;
    }else{
      $data->poster = "null";
    
    }
    $data->save();
    return redirect()->back()->with('success', __('messages.affiliate-program.created'));
  }

  public function editWorkshop($id){
    $item = Workshops::find($id);

    if (!$item) {
        return redirect()->back()->with('error', __('messages.workshop.not_found'));
    }

    return view('admin.edit-workshop', compact('item'));
  }
  public function editAffiliate($id){
    $item = AffliatePrograms::find($id);

    if (!$item) {
        return redirect()->back()->with('error', __('messages.affiliate-program.not_found'));
    }

    return view('admin.edit-affiliate-programs', compact('item'));
  }
  public function updateWorkshops(Request $request , $id){
    $data = Workshops::find($id);
    $data->title = $request->title;
    $data->description = $request->description;
    $data->status = $request->status;
    $data->card_description = $request->card_description;
    $data->price = $request->price;
    
    if ($request->hasFile('poster')) {
        if (!empty($data->poster)) {
            $oldFilePath = public_path('Images/' . basename($data->poster));
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $file = $request->file('poster');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '_' . rand() . '.' . $ext;
        $filePath = 'Images/' . $filename; 
        $file->move(public_path('Images'), $filename);
          $data->poster = $filename;
    }
    $data->save();
    return redirect()->route('admin.workshops')->with('success', __('messages.workshop.updated'));

  }

public function updateAffiliate(Request $request, $id)
{
    $data = AffliatePrograms::find($id);
    

    $data->title = $request->title;
    $data->description = $request->description;
    $data->status = $request->status;
    $data->card_description = $request->card_description;
    $data->price = $request->price;


    if ($request->hasFile('poster')) {
        if (!empty($data->poster)) {
            $oldFilePath = public_path('Images/' . basename($data->poster));
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $file = $request->file('poster');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '_' . rand() . '.' . $ext;
        $filePath = 'Images/' . $filename; 
        $file->move(public_path('Images'), $filename);
          $data->poster = $filename;
    }

    $data->save();

    return redirect()->route('admin.affiliate-programs')->with('success', __('messages.affiliate-program.updated'));
}


  public function travelmobilityAdd(Request $request){
    $data = new TravelMobility();
    $data->title = $request->title;
    $data->card_description = $request->card_description;
    $data->description = $request->description;
    $data->price = $request->price;
    $data->status = 'active';
    $data->category_id = $request->category_id;
    if ($request->hasFile('poster')) {
      $file = $request->file('poster');
      $ext = $file->getClientOriginalExtension();
      $filename = rand().'.'.$ext;
      $file->move('Images',$filename);
      $data->poster = $filename;
    }else{
      $data->poster = "null";

    }
    $data->save();
    return redirect()->back()->with('success', __('messages.travel-mobility.added'));




  }
  public function editTravelMobility($id) {
    $item = TravelMobility::findOrFail($id); 
    $categories = TravelMobilityCategories::all(); 
    return view('admin.edit-travel', compact('item', 'categories'));
  }



  public function updateTravelMobility(Request $request,$id){
    $data = TravelMobility::find($id);
    $data->title = $request->title;
    $data->description = $request->description;
    $data->status = $request->status;
    $data->category_id  = $request->category_id;
    $data->card_description = $request->card_description;
    $data->price = $request->price;


    if ($request->hasFile('poster')) {
        if (!empty($data->poster)) {
            $oldFilePath = public_path('Images/' . basename($data->poster));
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $file = $request->file('poster');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '_' . rand() . '.' . $ext;
        $filePath = 'Images/' . $filename; 
        $file->move(public_path('Images'), $filename);
          $data->poster = $filename;
    }


    $data->save();
    return redirect()->route('admin.travel-mobility')->with('success', __('messages.travel-mobility.updated'));
  }


  public function ContentHome(){
    $data= homeContent::first();
    return view('admin.content-management-home',compact('data'));
  }


public function UpdateHomeContent(Request $request)
{
    $data = homeContent::find(1);
    
    $fileFields = [
        'mainbanner',
        'firstsection_box1_image',
        'firstsection_box2_image',
        'firstsection_box3_image',
        'secondsection_box1_image',
        'secondsection_box2_image',
        'secondsection_box3_image',
        'thirdsection_box1_image',
        'thirdsection_box2_image',
        'thirdsection_box3_image',
        'lastsection_box1_image',
        'lastsection_box2_image',
        'lastsection_box3_image',
    ];
    
    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {

            if (!empty($data->$field)) {
                $oldFilePath = public_path($data->$field);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }


            $file = $request->file($field);
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '_' . rand() . '.' . $ext;
            $filePath = 'Images/' . $filename;
            $file->move(public_path('Images'), $filename);
            $data->$field = asset($filePath);
        }
    }

    $textFields = [
        'firstsection_title',
        'firstsection_box1_title', 'firstsection_box1_description',
        'firstsection_box2_title', 'firstsection_box2_description',
        'firstsection_box3_title', 'firstsection_box3_description',
        'secondsection_title',
        'secondsection_box1_title', 'secondsection_box1_description',
        'secondsection_box2_title', 'secondsection_box2_description',
        'secondsection_box3_title', 'secondsection_box3_description',
        'thirdsection_title',
        'thirdsection_box1_title', 'thirdsection_box1_description',
        'thirdsection_box2_title', 'thirdsection_box2_description',
        'thirdsection_box3_title', 'thirdsection_box3_description',
        'lastsection_title',
        'lastsection_box1_title', 'lastsection_box1_description',
        'lastsection_box2_title', 'lastsection_box2_description',
        'lastsection_box3_title', 'lastsection_box3_description',
    ];
    
    foreach ($textFields as $field) {
        if ($request->has($field)) {
            $data->$field = $request->$field;
        }
    }

    $data->save();

    return redirect()->back()->with('success', __('messages.home.updated'));
}

  public function profile(){
    $item = User::where('role', 'admin')->first(); 
    return view('admin.profile', compact('item'));
  }
  public function updateProfile(Request $req, $id)
  {
      $data = User::findOrFail($id);

      $data->firstName = $req->firstName;
      $data->lastName = $req->lastName;
      $data->email = $req->email;


      if ($req->hasFile('profile')) {
          $oldImagePath = public_path('Images/' . $data->profile);
          
          if ($data->profile && file_exists($oldImagePath)) {
              unlink($oldImagePath);
          }

          $file = $req->file('profile');
          $filename = uniqid() . '.' . $file->getClientOriginalExtension();
          $file->move(public_path('Images'), $filename);


          $data->profile = $filename;
      }

      $data->save();

      return redirect()->route('admin.profile')->with('success', __('messages.home.updated'));
  }



  public function addAppointments(Request $request)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'start_time' => 'required',
          'end_time' => 'required',
      ]);

      Appointments::create([
          'name' => $request->name,
          'start_time' => $request->start_time,
          'end_time' => $request->end_time,
      ]);

      return redirect()->back()->with('success', __('messages.appointment.created'));
  }
  public function editUserDetails($id){
    $item = User::find($id);
    return view('admin.edit-user',compact('item'));
  }

  public function updateUserDetails(Request $req  , $id)
  {
    $data = User::find($id);
    $data->firstName= $req->firstName;
    $data->lastName = $req->lastName;
    $data->email = $req->email;
    $data->status = $req->status;

    if ($req->hasFile('profile')) {
      $file = $req->file('profile');
      $ext = $file->getClientOriginalExtension();
      $filename = rand().'.'.$ext;
      $file->move('Images',$filename);
      $data->profile = $filename;
    }else{
    
    
    }
      $data->save();
    return redirect()->route('admin.user-management')->with('success', __('messages.user.updated'));
  }


        
  public function setting()
  {
      return view('admin.general_setting');
  }
        
        
  public function overWriteEnvFile($type, $val)
  {

          $path = base_path('.env');
          if (file_exists($path)) {
              $val = '"'.trim($val).'"';
              if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                  file_put_contents($path, str_replace(
                      $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                  ));
              }
              else{
                  file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
              }
          }
  }

  public function settingsubmit(Request $request)
  {
      foreach ($request->types as $key => $type) {
    
          if ($type == 'website_nameen') {
              $this->overWriteEnvFile('APP_NAME', $request[$type]);
          }

          $lang = null;
          if (gettype($type) == 'array') {
              $lang = array_key_first($type);
              $type = $type[$lang];
              $business_settings = Setting::where('type', $type)->where('lang', $lang)->first();
          } else {
              $business_settings = Setting::where('type', $type)->first();
          }

          if ($business_settings != null) {
              if (gettype($request[$type . $lang]) == 'array') {
                  $business_settings->value = json_encode($request[$type . $lang]);
              } else {
                  if ($request->hasFile($type . $lang)) {

                      if (!empty($request[$type . '_old' . $lang]) && file_exists(public_path('website/websitedata/' . $request[$type . '_old' . $lang]))) {
                          unlink(public_path('website/websitedata/' . $request[$type . '_old' . $lang]));
                      }

                      $file = $request->file($type . $lang);
                      $destinationPath = public_path('website/websitedata/');
                      
                      $file_name = time() . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                      
                      $file->move($destinationPath, $file_name);

                      if ($business_settings->value != null) {
                          $oldFile = public_path("website/websitedata/{$business_settings->value}");

                          if (File::exists($oldFile)) {
                              unlink($oldFile);
                          }
                      }

                      $business_settings->value = $file_name;
                  } else if ($type != 'header_logo') {
                      $business_settings->value = $request[$type . $lang];
                  }
              }
              $business_settings->lang = $lang;
              $business_settings->save();
          } else {
              $business_settings = new Setting;
              $business_settings->type = $type;

              if (gettype($request[$type . $lang]) == 'array') {
                  $business_settings->value = json_encode($request[$type . $lang]);
              } else {
                  if ($request->hasFile($type . $lang)) {
                      $file = $request->file($type . $lang);
                      $destinationPath = public_path('website/websitedata/');
                      
                      $file_name = time() . '-' . str_replace(' ', '-', $file->getClientOriginalName());

                      $file->move($destinationPath, $file_name);
                      $business_settings->value = $file_name;
                  } else {
                      $business_settings->value = $request[$type . $lang];
                  }
              }
              $business_settings->lang = $lang;
              $business_settings->save();
          }
      }
      return back()->with('success', _('messages.data_updated'));
  }


}


                
