<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateBookRequest extends FormRequest
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
    public function rules(Request $request)
    {
        /*
         * 'name' => 'required|between:4,255|unique:books,name,'.$request->get('id'),
         */
        //dd($request->get('id'));
        return [
            'name' => 'required|between:4,255|unique:books,name,'.$request->get('id'),
            'category_id' => 'required',
            'description' => 'required|min:10'
        ];
    }
}
