<?php

namespace App\Http\Requests;

use App\Rules\WithdrawWalletAddressCannotBeTheSameAsDepositRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WithdrawActionRequest extends FormRequest
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
            'amount' => ['required', 'integer', 'min:20'],
            'wallet_address'    => ['required', 'string', new WithdrawWalletAddressCannotBeTheSameAsDepositRule()],
            'password'  => ['required', 'string', 'current_password'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->checkPassword()) {
                $validator->errors()->add('password', 'The provided password is incorrect.');
            }
        });
    }

    protected function checkPassword()
    {
        return Hash::check($this->input('password'), Auth::user()->password);
    }
}
