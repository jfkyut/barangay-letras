<?php

namespace App\Http\Requests\OfficeSession;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfficeSessionRequest extends FormRequest
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
            'council_id' => ['required', 'exists:councils,id'],
            'type_id' => ['required', 'exists:office_session_types,id'],
            'year' => ['required', 'integer'],
            'session_no' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'remarks' => ['nullable', 'string'],
        ];
    }
}
