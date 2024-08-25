<?php

namespace Modules\News\Http\Requests;

use App\Rules\HashIdExists;
use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Modules\News\Entities\NewsCategory;
use Modules\User\Enums\PermissionsEnum;

class StoreNewsRequest extends FormRequest
{
    use SanitizesInput;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'youtube_url' => 'nullable|string|url',
            'categories' => 'nullable|array',
            'categories.*' => [
                'nullable',
                new HashIdExists(NewsCategory::class),
            ],
            'status' => 'nullable|in:0,1',
        ];
    }

    public function filters()
    {
        return [
            'title' => 'trim|escape',
            'content' => 'trim',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::CREATE_NEWS->value);
    }
}
