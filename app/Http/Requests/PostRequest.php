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
    public function rules() {
        return [
            'files.*.photo' => 'required|file|mimes:jpeg,png,jpg,bmb|max:8192',
            'files' => 'max:2',
            'post.body' => 'max:400',
        ];
    }
    
    public function messages() {
  return  [
    'files.*.photo.required' => '画像を選択してください',
    'files.*.photo.mimes' => '拡張子はjpeg,png,jpg,bmbのみです',
    'files.max' => '選択可能なファイルは2つ目までです',
    'post.body.max' => '最大400文字までです',
  ];
}
    
}
