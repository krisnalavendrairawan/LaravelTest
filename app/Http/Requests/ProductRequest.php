<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama produk wajib diisi',
            'nama.max' => 'Nama produk maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi produk wajib diisi',
            'harga.required' => 'Harga produk wajib diisi',
            'harga.numeric' => 'Harga produk harus berupa angka',
            'harga.min' => 'Harga produk tidak boleh negatif',
            'stok.required' => 'Stok produk wajib diisi',
            'stok.integer' => 'Stok produk harus berupa bilangan bulat',
            'stok.min' => 'Stok produk tidak boleh negatif',
        ];
    }
}
