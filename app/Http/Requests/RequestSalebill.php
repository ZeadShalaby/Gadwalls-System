<?php

namespace App\Http\Requests;

use App\Enums\TaxEnums;
use Illuminate\Foundation\Http\FormRequest;

class RequestSalebill extends FormRequest
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
            'code' => 'required|exists:products,code|string|min:8|max:48',               // Code must be required, a string, and max 20 characters
            'name' => 'required|string|max:255',              // Name must be required, a string, and max 255 characters
            'quantity' => 'required|integer|min:1',           // Quantity must be required, an integer, and at least 1
            'price' => 'required|numeric|min:0',              // Price must be required, numeric, and at least 0
            'store_id' => 'required|exists:stores,id|string|max:255',          // Store ID must be required, a string, and max 255 characters
            'supplier_id' => 'required|exists:suppliers,id|string|max:255',       // Supplier ID must be required, a string, and max 255 characters
            'selected_option' => 'nullable|integer|in:' . implode(',', array_column(TaxEnums::cases(), 'value')),
            'checkbox1' => 'nullable|boolean',                 // Checkbox1 can be null or a boolean
        ];
    }
}
