<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'total_cash'=>'required|integer',
            'package_type'=>'required',
            'number_of_items'=>'required',
            'desc'=>'required',
            'name'=>'required',
            'city'=>'required',
            'area'=>'required',
            'street'=>'required',
            'landmarks'=>'required',
            'mobile'=>'required',
            'mobile'=>'required',
            'mobile'=>'required',


        ];
    }
}
