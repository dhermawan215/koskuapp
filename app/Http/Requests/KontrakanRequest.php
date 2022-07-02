<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KontrakanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'district' => 'required|max:255',
            'regency' => 'required|max:255',
            'facility' => 'required',
            'price' => 'required|integer',
            'status' => 'required',
            'ratings' => 'required|numeric',
            'tags' => 'required',
            'whatsapp_number' => 'required',
            'gmap_url' => "required|url",
            'latitude' => "required|string|max:255",
            'longtitude' => "required|string|max:255",
            'picture' => 'file|image|mimes:png,jpg,jpeg'

        ];
    }
}
