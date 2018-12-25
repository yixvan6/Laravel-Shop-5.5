<?php

namespace App\Http\Requests;

class UserAddressRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'province'      => 'required|string',
            'city'          => 'required|string',
            'district'      => 'required|string',
            'address'       => 'required|string',
            'zip'           => 'integer|length:6',
            'contact_name'  => 'required|string',
            'contact_phone' => 'required|regex:/^1[34578]\d{9}$/',
        ];
    }

    public function attributes()
    {
        return [
            'province'      => '省',
            'district'      => '地区',
            'address'       => '详细地址',
            'zip'           => '邮编',
            'contact_name'  => '姓名',
            'contact_phone' => '电话',
        ];
    }
}
