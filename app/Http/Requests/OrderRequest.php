<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Illuminate\Validation\Rule;

class OrderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 判断用户提交的地址 id 是否存在并且属于当前用户
            'address_id' => ['required', Rule::exists('user_addresses', 'id')->where('user_id', $this->user()->id)],
            'items' => ['required', 'array'],
            'items.*.sku_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ( ! $sku = ProductSku::find($value)) {
                        $fail('该商品不存在');
                        return;
                    }
                    if ( ! $sku->product->on_sale) {
                        $fail('该商品未上架');
                        return;
                    }
                    if ($sku->stock === 0) {
                        $fail('该商品已售完');
                        return;
                    }

                    preg_match('/items\.(\d+)\.sku_id/', $attribute, $m);
                    $index = $m[1];

                    $amount = $this->items[$index]['amount'];
                    if ($amount > 0 && $amount > $sku->stock) {
                        $fail('该商品库存不足');
                        return;
                    }
                },
            ],
            'items.*.amount' => 'required|integer|min:1',
        ];
    }
}