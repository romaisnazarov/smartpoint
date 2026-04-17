<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'resource_id' => 'required|exists:resources,id',
            'external_id' => 'required|string|max:255',
            'monitoring_frequency' => 'required|in:4,6,8',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'resource_id.required' => 'Необходимо указать ресурс',
            'resource_id.exists' => 'Указанный ресурс не существует',
            'external_id.required' => 'Необходимо указать идентификатор блога',
            'monitoring_frequency.required' => 'Необходимо указать частоту мониторинга',
            'monitoring_frequency.min' => 'Частота мониторинга не может быть меньше 4 часов',
            'monitoring_frequency.max' => 'Частота мониторинга не может быть больше 8 часов',
        ];
    }
}
