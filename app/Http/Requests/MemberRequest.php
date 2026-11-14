<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->route('anggotum') ?? $this->route('anggota');
        $userId = $user instanceof User ? $user->id : $user;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'role' => 'required|in:admin,guru,siswa',
            'nis' => 'nullable|string|max:20',
            'nip' => 'nullable|string|max:30',
            'kelas' => 'nullable|string|max:20',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status_aktif' => 'required|boolean',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:6';
        } else {
            $rules['password'] = 'nullable|string|min:6';
        }

        return $rules;
    }
}
