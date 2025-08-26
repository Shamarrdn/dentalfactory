<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
        $pageId = $this->route('page') ? $this->route('page')->id : null;

        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('pages', 'slug')->ignore($pageId),
            ],
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الصفحة مطلوب',
            'title.max' => 'عنوان الصفحة يجب أن يكون أقل من 255 حرف',
            'slug.regex' => 'الرابط المميز يجب أن يحتوي على أحرف إنجليزية صغيرة وأرقام وشرطات فقط',
            'slug.unique' => 'الرابط المميز مستخدم بالفعل',
            'content.required' => 'محتوى الصفحة مطلوب',
            'status.required' => 'حالة النشر مطلوبة',
            'status.in' => 'حالة النشر يجب أن تكون منشورة أو مسودة',
            'sort_order.integer' => 'ترتيب الصفحة يجب أن يكون رقم',
            'sort_order.min' => 'ترتيب الصفحة يجب أن يكون 0 أو أكثر',
            'meta_title.max' => 'عنوان SEO يجب أن يكون أقل من 255 حرف',
            'meta_description.max' => 'وصف SEO يجب أن يكون أقل من 500 حرف',
            'meta_keywords.max' => 'كلمات SEO يجب أن تكون أقل من 500 حرف',
        ];
    }
}
