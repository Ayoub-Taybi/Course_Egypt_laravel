<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Http\Requests\OfferRequest;

use LaravelLocalization;


use App\Traits\OfferTrait;



class AjaxOfferController extends Controller
{

    use OfferTrait;
    

    public function index()
    {
       
        $offers = Offer::select('id', 'name_'.LaravelLocalization::getCurrentLocale().' as name','price','details_'.LaravelLocalization::getCurrentLocale().' as details','photo')->get(); // return collection
        return view('ajaxoffers.all', compact('offers'));
  
    }


    public function create()
    {
        return view('ajaxoffers.create');
    }


    public function store(OfferRequest $request)
    {

         
         $file_name= $this->saveImage($request->photo,'images/offers');
        
        //insert
         $offer  = Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'photo' => $file_name,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        if ($offer)
        return response()->json([
            'status' => true,
            'msg' => 'تم الحفظ بنجاح',
        ]);

    else
        return response()->json([
            'status' => false,
            'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
        ]);



    }


    public function delete(Request $request)
    {
        //check if offer id exists

        //  $offer = Offer::where('id',$offer_id)->delete();

        $offer = Offer::find($request->id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
        
             return response()->json([
                'status' => false,
                'msg' => __('messages.offer not exist'),
                'id' =>  $request -> id
            ]);


            $this->removeImage($offer->photo);
            $offer->delete();

        // Offer::destroy($offer_id); 

        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' =>  $request -> id
        ]);
    
    }



    public function edit($offer_id)
    {
        // Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
          // search in given table id only

        if (!$offer)
            return redirect()->back()->with(['error' => "This offer doesn't exist"]);

        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);

        return view('ajaxoffers.edit', compact('offer'));

    }


    public function Update(OfferRequest $request)
    {
        
        $offer = Offer::find($request->id);

        if (!$offer)
        return response()->json([
            'status' => false,
            'msg' => 'هذ العرض غير موجود',
        ]);

       

        $path_photo= $this->saveImage($request->photo,'images/offers');

         if(!$path_photo){

            $offer->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'price' => $request->price,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
            ]);
         }else{

            $this->removeImage($offer->photo);

            $offer->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'price' => $request->price,
                'photo' => $path_photo,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
            ]);

         }
        

        return response()->json([
            'status' => true,
            'msg' => 'تم  التحديث بنجاح',
        ]);

     

    }



}
