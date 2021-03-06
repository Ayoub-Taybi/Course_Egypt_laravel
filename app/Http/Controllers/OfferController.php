<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;

use App\Traits\OfferTrait;

use LaravelLocalization;




class OfferController extends Controller
{


    use OfferTrait;



    public function getOffers()
    {
        return Offer::select('id', 'name')->get();
    }

    public function index()
    {
       
        $offers = Offer::select('id', 'name_'.LaravelLocalization::getCurrentLocale().' as name','price','details_'.LaravelLocalization::getCurrentLocale().' as details','photo')->get(); // return collection
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


         //save photo in folder
         
         $file_name= $this->saveImage($request->photo,'images/offers');
        


        //insert
        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'photo' => $file_name,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        return redirect()->back()->with(['success' => 'تم اضافه العرض بنجاح ']);

    }


   

    public function editOffer($offer_id)
    {
        // Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
          // search in given table id only
        if (!$offer)
            return redirect()->back();

        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);

        return view('offers.edit', compact('offer'));

    }

    public function UpdateOffer(OfferRequest $request, $id)
    {

        //validtion

        //   $rules = $this->getRules($id);

        //   $messages = $this->getMessages();

        // // // Methode 1

        //  $request->validate($rules,$messages);

        

        // chek if offer exists

        $offer = Offer::find($id);
        if (!$offer)
            return redirect()->back();

        //update data

        $offer->update($request->all());

        return redirect() -> back() -> with(['success' => ' تم التحديث بنجاح ']);

      /*  $offer->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
        ]);*/

    }

    
    public function delete($offer_id)
    {
        //check if offer id exists

        //  $offer = Offer::where('id',$offer_id)->delete();

        $offer = Offer::find($offer_id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $this->removeImage($offer->photo);
        $offer->delete();


        // Offer::destroy($offer_id); 

        return redirect()
            ->route('offers.index')
            ->with(['success' => __('messages.offer deleted successfully')]);

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

    //     return [
    //         'name_ar' => "required|max:100|unique:offers,name_ar",
    //         'price' => 'required|numeric',
    //         'details_ar' => 'required', 
    //         'name_en' => "required|max:100|unique:offers,name_en",
    //         'details_en' => 'required',
    //     ];
    // }



    public function openImageBrowser($id)
    {

        $offer = Offer::find($id);

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        if (!$offer->photo)
            return redirect()->back()->with(['error' => __('this offer has not image !!!')]);
       
        return response()->file($offer->photo);


    }



  



}
