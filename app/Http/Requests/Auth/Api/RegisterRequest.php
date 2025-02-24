<?php

namespace App\Http\Requests\Auth\Api;
use Illuminate\Foundation\Http\FormRequest;
class RegisterRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }
}