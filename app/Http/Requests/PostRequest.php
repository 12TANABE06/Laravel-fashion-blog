<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *z

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
       
        return [
            'files.*.photo' => 'required|file|mimes:jpeg,png,jpg,bmb|max:2048',
            'files' => 'max:2',
            'post.body' => 'max:400',
        ];
    }
}
