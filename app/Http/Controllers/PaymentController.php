<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepaymentRequest;
use App\Http\Requests\UpdatepaymentRequest;
use App\Models\Enroll;
use App\Models\payment;
use App\Models\Workshops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($module_type, $module_id)
    {
        if (!auth()->check()) {
            session(['module_type' => $module_type, 'module_id' => $module_id]);
            return redirect()->route('account.login')->with('error', __('messages.enrollment_login'));
        }


        return view('user.enroll.payment',compact('module_type','module_id'));
    }
    public function processPayment(Request $request)
{
    $request->validate([
        'card_number' => 'required',
        'person_card_name' => 'required',
        'module_type' => 'required',
        'module_id' => 'required'
    ]);
    DB::beginTransaction();

    try {

        $payment = new Payment();
        $payment->payment = 'Completed'; 
        $payment->card_number = $request->card_number;
        $payment->person_card_name = $request->person_card_name;
        $payment->user_id = Auth::id();
        $payment->save();


        $module_type=decrypt($request->module_type);
        $module_id=decrypt($request->module_id);
        $enroll = new Enroll();
        $enroll->user_id = Auth::id();
        $enroll->module_type = $module_type;
        $enroll->module_id = $module_id;
        $enroll->status = 'Enrolled';
        $enroll->payment_status = 'paid';
        $enroll->book_date = Carbon::now(); 

        $enroll->save();

        DB::commit();

        return redirect()->route('account.dashboard')->with('success', __('messages.payment.successful_payment'));
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error',__('messages.payment.payment_failed') );
    }
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepaymentRequest $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(payment $payment)
    {
        //
    }
}
