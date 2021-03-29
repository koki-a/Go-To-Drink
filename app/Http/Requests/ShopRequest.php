<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'shop-image'    => ['file', 'image','nullable'],
            'name'          => ['string','max:30','required'],
            'tell'          => ['required','numeric','digits_between:8,12'],
            'address'       => ['string','max:50','required'],
            'url'           => ['string','max:200','nullable'],
            'genre'         => ['required'],
            'situation_ids' => ['required'],
            'comment'       => ['string','max:500','nullable'],
        ];      
    }

    public function attributes()
    {
        return [
            'shop-image' => '店舗画像',
            'name'       => 'お店の名前',
            'address'    => '住所',
            'url'        => 'URL',
            'tell'       => '電話番号',
            'genre'      => 'ジャンル',
            'situation_ids'  => 'こだわり',
            'comment'    => 'コメント',
        ];
    }
}
