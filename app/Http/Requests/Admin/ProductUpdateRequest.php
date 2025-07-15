<?php

namespace App\Http\Requests\Admin;

class ProductUpdateRequest extends ProductStoreRequest
{
    public function rules(): array
    {
       return [
            'name' => 'min:1|max:255|required|unique:product,name,'.$this->route('id'),
            'slug' => 'min:1|max:255|required',
            'status' => 'required'
        ];
    }
}
