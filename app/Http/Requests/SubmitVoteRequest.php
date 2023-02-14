<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitVoteRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'polling_unit_number' => ['required', 'max:9', 'string'],
            'party_abbreviation' => ['required', 'string'],
            'party_vote' => ['required', 'integer'],
            'admin_name' => ['required', 'string'],
        ];
    }
}
