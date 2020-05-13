<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

       
        return [
            'name_ar' => ["required","max:100",Rule::unique('offers', 'name_ar')->ignore($this->offer_id)],
            'price' => 'required|numeric',
            'details_ar' => 'required', 
            'name_en' => "required|max:100|unique:offers,name_en,$this->offer_id",
            'details_en' => 'required',
            'photo'=>'required|image|mimes:jpeg,png',
        ];

    }

    public function messages(){
 
        return  [
                    'name_ar.required' => trans('messages.offer name required'),
                    'name_en.required' => trans('messages.offer name required'),
                    'name.unique' => __('messages.offer name must be unique'),
                    'price.numeric' => 'سعر العرض يجب ان يكون ارقام',
                    'price.required' => __('messages.Price required'),
                    'details_ar.required' => __('messages.Details required'),
                    'details_en.required' => __('messages.Details required'),
                ];


    }





}
