<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageUpdate extends FormRequest
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
            "content" => "required",
        ];
    }

    public function messages()
    {
        return [
            "message.required" => "The message field is required.",
            "isPrivate.required" => "The message privacy field is required.",
            "isPrivate.integer" => "Please select valid message privacy options.",
            "isPrivate.in" => "The message privacy must be either public or private.",
            "type.required" => "The type field is required.",
            "type.integer" => "Please select valid message type options.",
            "type.in" => "The message type must be in Text, Image or Video.",
            "duration.required" => "The message duration field is required.",
            "duration.integer" => "Please select valid message duration options.",
            "password.required" => "The password field is required.",
            "password.min" => "The password length must be minimum 4 character.",
        ];
    }
}
