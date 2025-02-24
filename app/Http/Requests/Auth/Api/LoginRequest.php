<?php
namespace App\Http\Requests\Auth\Api;
use Illuminate\Foundation\Http\FormRequest;
class LoginRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا.',
            'password.required' => 'كلمة المرور مطلوبة.',
        ];
    }
}