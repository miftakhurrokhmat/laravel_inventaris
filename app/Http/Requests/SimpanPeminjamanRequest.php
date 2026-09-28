<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SimpanPeminjamanRequest extends FormRequest
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
            'inventaris_id' => 'required|exists:inventaris,id',
            'tanggal_pinjam' => 'required|date',
            'rencana_kembali' => 'required|date|after:tanggal_pinjam',
            'catatan' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'inventaris_id.exists' => 'Barang tidak ditemukan.',
            'rencana_kembali.after' => 'Tanggal kembali harus setelah tanggal pinjam.',
        ];
    }
}
