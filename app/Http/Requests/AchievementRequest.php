<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AchievementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can add authorization logic here if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft',
            'published_at' => 'nullable|date'
        ];

        // If this is an update request, make the slug validation ignore current record
        if ($this->route('achievement')) {
            $rules['slug'] = [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('achievements')->ignore($this->route('achievement'))
            ];
        }

        return $rules;
    }

    /**
     * Get custom attribute names for validator errors.
     */
    public function attributes(): array
    {
        return [
            'title' => 'العنوان',
            'short_description' => 'الوصف القصير',
            'content' => 'المحتوى',
            'cover_image' => 'صورة الغلاف',
            'status' => 'حالة النشر',
            'published_at' => 'تاريخ النشر'
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'العنوان مطلوب',
            'title.max' => 'العنوان لا يجب أن يتجاوز 255 حرفاً',
            'short_description.required' => 'الوصف القصير مطلوب',
            'short_description.max' => 'الوصف القصير لا يجب أن يتجاوز 500 حرف',
            'content.required' => 'المحتوى مطلوب',
            'cover_image.image' => 'صورة الغلاف يجب أن تكون صورة صالحة',
            'cover_image.mimes' => 'صورة الغلاف يجب أن تكون من نوع: jpeg, png, jpg, gif',
            'cover_image.max' => 'حجم صورة الغلاف لا يجب أن يتجاوز 2 ميجابايت',
            'status.required' => 'حالة النشر مطلوبة',
            'status.in' => 'حالة النشر يجب أن تكون منشور أو مسودة',
            'published_at.date' => 'تاريخ النشر يجب أن يكون تاريخ صحيح'
        ];
    }
}
