<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            //お名前
            'last_name' => 'required|string|max:8',
            'first_name' => 'required|string|max:8',

            //性別
            'gender' => 'required',

            //メールアドレス
            'email' => 'required|email',

            //電話番号
            'tel1' => 'required|numeric|digits_between:1,5',
            'tel2' => 'required|numeric|digits_between:1,5',
            'tel3' => 'required|numeric|digits_between:1,5',

            //住所
            'address' => 'required',

            //お問い合わせの種類
            'category_id' => 'required',

            //お問い合わせの内容
            'detail' => 'required|max:120'
        ];
    }

    public function messages()
    {
        return [
            //お名前
            'last_name.required' => '姓を入力してください',
            'last_name.string'   => '姓を入力してください',
            'last_name.max'      => '姓を入力してください',

            'first_name.required' => '名を入力してください',
            'first_name.string'   => '名を入力してください',
            'first_name.max'      => '名を入力してください',


            //性別
            'gender.required' => '性別を選択してください',

            //メールアドレス
            'email.required' => 'メールアドレスを入力してください',
            'email.email'    => 'メールアドレスはメール形式で入力してください',

            //住所
            'address.required' => '住所を入力してください',

            //お問い合わせの種類
            'category_id.required' => 'お問い合わせの種類を選択してください',

            //お問い合わせの内容
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max'      => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }

    //電話番号
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if (
                empty($this->tel1) ||
                empty($this->tel2) ||
                empty($this->tel3))
            {
                $validator->errors()->add('tel', '電話番号を入力してください');
                return;
            }

            if (
                (!ctype_digit($this->tel1) && $this->tel1 !== '') ||
                (!ctype_digit($this->tel2) && $this->tel2 !== '') ||
                (!ctype_digit($this->tel3) && $this->tel3 !== '')
                )
            {
                $validator->errors()->add('tel', '電話番号は半角英数字で入力してください');
            }

            if (
                (strlen($this->tel1) > 5) ||
                (strlen($this->tel2) > 5) ||
                (strlen($this->tel3) > 5)
                )
            {
                $validator->errors()->add('tel', '電話番号は5桁までで入力してください');
            }

        });
    }
}
