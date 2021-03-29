<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class EditRequest extends FormRequest
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
            'avatar'    => ['file', 'image','nullable'],
            'name'    => ['string','max:20',Rule::unique('users')->ignore(Auth::id()),'required'],
        ];
    }

    public function attributes()
    {
        return [
            'avatar'    => 'プロフィール画像',
            'name'    => '名前',
        ];
    }
}
