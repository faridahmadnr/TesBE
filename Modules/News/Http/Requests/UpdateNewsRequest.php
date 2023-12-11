<?php

namespace Modules\News\Http\Requests;

use App\Rules\HashIdExists;
use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Modules\News\Entities\NewsCategory;
use Modules\User\Enums\PermissionsEnum;

class UpdateNewsRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'featured_image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categories' => 'sometimes|array',
            'categories.*' => [
                'sometimes',
                new HashIdExists(NewsCategory::class),
            ],
            'status' => 'sometimes|in:0,1',
        ];
    }

    public function filters()
    {
        return [
            'title' => 'trim|escape',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::UPDATE_NEWS->value);
    }
}
