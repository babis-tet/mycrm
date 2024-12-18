<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $customerId = $this->route('customer')->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customerId,
            'phone' => 'nullable|string|max:15',
            'vat' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
        ];
    }
}
