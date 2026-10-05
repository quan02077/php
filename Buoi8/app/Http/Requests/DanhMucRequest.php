<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DanhMucRequest extends FormRequest
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
        $danhmuc = $this->route('danhmuc');
        $id = is_object($danhmuc) ? $danhmuc->id : $danhmuc;
        return [
            'ten' => ['required', 'string', 'max:150', "unique:danh_mucs,ten,{$id}"],
            'slug' => ['nullable', 'string', 'max:160', 'alpha_dash', "unique:danh_mucs,slug,{$id}"],
        ];
    }

    public function messages(): array
    {
        return [
            'ten.required' => 'Tên danh mục bắt buộc.',
            'ten.unique' => 'Tên danh mục đã tồn tại.',
            'slug.required' => 'Slug bắt buộc.',
            'slug.alpha_dash' => 'Slug chỉ gồm chữ, số, gạch ngang, gạch dưới.',
            'slug.unique' => 'Slug đã tồn tại.',
        ];
    }
}
