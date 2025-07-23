<?php

namespace App\Http\Requests\Admin;

class ProductUpdateRequest extends ProductStoreRequest
{
    public function rules(): array
    {
       return [
            'name' => 'min:1|max:255|required|unique:product,name,'.$this->route('product'),
            'price' => 'required',
            'product_category_id' => 'required',
            'status' => 'required',
            'discount_percentage' => 'nullable|numeric|min:0|max:1',
        ];
    }
}
