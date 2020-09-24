<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Post;

class PostRequest extends FormRequest
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

      if ($this->isMethod('get')) return [];

        return [
            'title' =>  'required|min:3|max:50',
            // 'address' =>  'required',
            'body' => 'required|max:2000',
            'files.*.image' => 'image|mimes:jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '名前は入力必須です。',
            'address.required' => '住所は入力必須です。',
            'body.required' => '詳細は入力必須です。',
            // 'file.required' => '画像ファイルを選択してください',

            // 'image.required' => '画像はアップロード必須です。'
            //'title.required'←タイトルが入力されなかったとき、
            //'please enter title!!!'と出力する。
        ];
    }


}
