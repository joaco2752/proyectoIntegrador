<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validadorDonativo extends FormRequest
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
        $rules = [
            'name' => 'required',
            'email' => 'email:dns,rfc',
            'amount' => 'required|numeric|gt:0|lt:10000'
            ,
        ,
            'payment_method' => 'required|in:credit_card,paypal,crypto',
        ];

        // Only add validation rules for the selected payment method
        $paymentMethod = $this->input('payment_method');

        if ($paymentMethod === 'credit_card') {
            $rules['card_number'] = 'required';
            $rules['expiry_date'] = 'required';
            $rules['cvv'] = 'required';
            $rules['card_holder'] = 'required';
        } elseif ($paymentMethod === 'paypal') {
            $rules['paypal_email'] = 'required|email';
            $rules['paypal_name'] = 'required';
        } elseif ($paymentMethod === 'crypto') {
            $rules['crypto_type'] = 'required';
            $rules['wallet_address'] = 'required';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'email.email' => 'El correo electrónico debe ser válido',
            'amount.required' => 'La cantidad es obligatoria',
            'amount.numeric' => 'La cantidad debe ser un número',
            'amount.min' => 'La cantidad mínima es $1',
            'payment_method.required' => 'Debes seleccionar un método de pago',
            'payment_method.in' => 'El método de pago seleccionado no es válido',

            // Credit card messages
            'card_number.required' => 'El número de tarjeta es obligatorio',
            'expiry_date.required' => 'La fecha de expiración es obligatoria',
            'cvv.required' => 'El código CVV es obligatorio',
            'card_holder.required' => 'El nombre del titular es obligatorio',

            // PayPal messages
            'paypal_email.required' => 'El correo de PayPal es obligatorio',
            'paypal_email.email' => 'El correo de PayPal debe ser válido',
            'paypal_name.required' => 'El nombre de la cuenta PayPal es obligatorio',

            // Crypto messages
            'crypto_type.required' => 'Debes seleccionar un tipo de criptomoneda',
            'wallet_address.required' => 'La dirección de la billetera es obligatoria',

            //Validador mensaje

            'amount.gt' => 'La donación debe ser mayor a $0',
            'amount.lt' => 'La donación debe ser menor a $10,000',
        ];
    }
}