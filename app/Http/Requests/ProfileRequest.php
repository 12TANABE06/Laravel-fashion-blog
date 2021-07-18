<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'profile.image_path' => 'file|mimes:jpeg,png,jpg,bmb|max:2048',
            'profile.body' => 'max:400',
        ];
    }
    public function messages(){
        return  [
            'profile.image_path.mimes' => '拡張子はjpeg,png,jpg,bmbのみです',
            'profile.body.max' => '最大400文字までです',
            ];
}
}
