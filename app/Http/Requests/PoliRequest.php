<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoliRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'penyakit' => ['required', 'string', 'max:255'],
            'dokter_id' => ['required'],
            'keterangan' => ['required', 'string', 'max:255'],
        ];
    }


    public function messages()
    {
        return[
            'dokter_id.required' => 'field dokter required'
        ];
    }

}
