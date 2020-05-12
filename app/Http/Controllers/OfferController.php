<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use LaravelLocalization;




class OfferController extends Controller
{
    public function getOffers()
    {
        return Offer::select('id', 'name')->get();
    }

    public function index()
    {
       
        $offers = Offer::select('id', 'name_'.LaravelLocalization::getCurrentLocale().' as name','price','details_'.LaravelLocalization::getCurrentLocale().' as details')->get(); // return collection
        return view('offers.all', compact('offers'));
  
    }


    /* public function store()
     {
         Offer::create([
             'name' => 'Offer3',
             'price' => '5000',
             'details' => 'offer details',
         ]);
     }*/


    public function create()
    {
        return view('offers.create');
    }


    public function store(OfferRequest $request)
    {

        //validate data before insert to database

        //  $rules = $this->getRules();

        //  $messages = $this->getMessages();

        // // Methode 1

        //  $request->validate($rules,$messages);
        

// //          Methode 2

//       $validator = Validator::make($request->all(), $rules, $messages);

//      if ($validator->fails()) {
//           return redirect()->back()->withInput()->withErrors($validator);
//      }


        //insert
        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        return redirect()->back()->with(['success' => 'تم اضافه العرض بنجاح ']);

    }


    // private function getMessages()
    // {

    //     return $messages = [
    //         'name.required' => trans('messages.offer name required'),
    //         'name.unique' => __('messages.offer name must be unique'),
    //         'price.numeric' => 'سعر العرض يجب ان يكون ارقام',
    //         'price.required' => __('messages.Price required'),
    //         'details.required' => __('messages.Details required'),
    //     ];
        
    // }

    // private function getRules()
    // {

    //     return $rules = [
    //         'name' => 'required|max:100|unique:offers',
    //         'price' => 'required|numeric',
    //         'details' => 'required',
    //     ];
    // }
}
