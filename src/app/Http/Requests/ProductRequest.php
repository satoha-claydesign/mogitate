<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
                'name' => 'required',
                'price' => 'required|integer|min:0|max:10000',
                'description' => 'required|max:120',
                'allseason_ids' => 'required',
                'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',  //画像ファイルのバリデーション
            ];

    }
    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '値段は数値で入力してください',
            'price.max' => '値段は0∼10000円以内で入力してください',
            'price.min' => '値段は0∼10000円以内で入力してください',
            'image.required' => '画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'allseason_ids.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}
