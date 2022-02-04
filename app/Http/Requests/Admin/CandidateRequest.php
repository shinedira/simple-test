<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('senior-hrd');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required|string|max:255',
            'email'            => 'required|email',
            'phone'            => 'required|numeric|digits_between:8,13',
            'birth_date'       => 'required|date',
            'education'        => 'nullable|string',
            'last_position'    => 'nullable|string',
            'experience'       => 'nullable|string',
            'applied_position' => 'required|string|max:255',
            'skills'           => 'required|array|min:1',
            'skills.*'         => 'required|exists:skills,id',
            'file'             => 'nullable|max:5000|mimes:pdf' //max 5MB
        ];
    }
}
