<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskQuestionRequest extends FormRequest
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
            //this is connect with form validation
            'title'=>'required|max:255', // '|'sign mane holo or
            'body' =>'required',
        ];
    }
}
