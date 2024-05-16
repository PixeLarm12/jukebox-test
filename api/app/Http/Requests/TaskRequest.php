<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:50',
            'description' => 'required|min:3|max:200',
            'user_id' => 'required|integer',
        ];
    }

    public function getData(): array
    {
        return [
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'user_id' => $this->input('user_id'),
        ];
    }
}
