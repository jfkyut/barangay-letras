<?php

namespace App\Http\Requests\Incoming;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomingCommunicationRequest extends FormRequest
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
            'year' => 'required|integer',
            'month' => 'required',
            'sequence_no' => 'required|integer',
            'reference_no' => 'required|string|unique:incoming_communications,reference_no',
            'classification' => 'string|required',
            'sender' => 'required|string',
            'subject' => 'required|string',
            'date_received' => 'required|date',
            'addressee' => 'required|string',
            'required_action' => 'string|required',
            'remarks' => 'nullable|string'
        ];
    }
}
