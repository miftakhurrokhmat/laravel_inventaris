<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SimpanInventarisRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nama' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id',
            'kondisi_id' => 'required|exists:kondisi,id',
            'tanggal_perolehan' => 'required|date|before_or_equal:today',
            'harga' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama barang wajib diisi.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'kondisi_id.exists' => 'Kondisi tidak valid.',
            'tanggal_perolehan.before_or_equal' => 'Tanggal tidak boleh di masa depan.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ];
    }
}
