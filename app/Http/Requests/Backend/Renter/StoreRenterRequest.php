<?php

namespace App\Http\Requests\Backend\Renter;

use Illuminate\Foundation\Http\FormRequest;

class StoreRenterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('store-renter');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Put your rules for the request in here
            //For Example : 'title' => 'required'
            //Further, see the documentation : https://laravel.com/docs/5.4/validation#creating-form-requests
            'name' => ['string' , 'max:50' ],
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'identity' => ['string' , 'max:15' ],
            //'price' => ['numeric','not_in:0'],
            //'description_ar' => ['string' , 'max:255'],
            //'image' => ['mimes:jpeg,png,jpg,svg','max:50240'],
        ];
    }

    public function messages()
    {
        return [
            //The Custom messages would go in here
            //For Example : 'title.required' => 'You need to fill in the title field.'
            //Further, see the documentation : https://laravel.com/docs/5.4/validation#customizing-the-error-messages
        ];
    }
}
