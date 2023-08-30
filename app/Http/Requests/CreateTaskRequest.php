<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatusModel;
use Illuminate\Validation\Rules\Enum;
class CreateTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            

            'title' => 'required|string|max:40',
            'description' => 'required|string|max:255',
            'deadline' => 'required|date_format:Y-m-d|after:now',
            'user_id' => 'required',
            'client_id' => 'required',
            'project_id' => 'required',
            'status' => [new Enum(StatusModel::class)]
        ];
    }
}
