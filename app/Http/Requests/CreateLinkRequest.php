<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'link-id'            => ['required', 'exists:links,id'],
            'domain-id'          => ['required', 'exists:domains,id'],
            'slug'               => ['required', 'max:50'],
            'target-url'         => ['required'],
            'image'              => ['nullable', 'mimes:jpg,png,gif,jpeg', 'max:5000'],
            'main-text'          => ['required_if:advertising-enabled,true', 'max:250'],
            'secondary-text'     => ['required_if:advertising-enabled,true', 'max:500'],
            'ad-target'          => ['required_if:advertising-enabled,true'],
            'delay'              => ['required_if:advertising-enabled,true', 'integer', 'min:0', 'max:30'],
            'show-progress-bar'  => ['required_if:advertising-enabled,true', 'boolean'],
            'show-skip-button'   => ['required_if:advertising-enabled,true', 'boolean'],
            'page-bg-hex'        => ['nullable', 'string', 'max:8'],
            'main-text-hex'      => ['nullable', 'string', 'max:8'],
            'secondary-text-hex' => ['nullable', 'string', 'max:8'],
        ];
    }

    public function attributes()
    {
        return [
            'link-id'             => 'link',
            'domain-id'           => 'domain',
            'slug'                => 'slug',
            'target-url'          => 'target URL',
            'image'               => 'image',
            'main-text'           => 'main text',
            'secondary-text'      => 'secondary text',
            'ad-target'           => 'ad target',
            'delay'               => 'delay',
            'show-progress-bar'   => 'show progress bar',
            'show-skip-button'    => 'shop skip button',
            'page-bg-hex'         => 'page background color hex code',
            'main-text-hex'       => 'main text color hex code',
            'secondary-text-hex'  => 'secondary text color hex code',
            'advertising-enabled' => 'redirect advertising',
        ];
    }
}
