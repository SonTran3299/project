<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'min:1|max:255|required|unique:product,name',
            'slug' => 'min:1|max:255|required',
            'status' => 'required'
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Bắt buộc phải nhập tên',
            'name.min' => 'Nhập tên lớn hơn 1',
            'status.required' => 'Chọn trạng thái'
        ];
    }
}
