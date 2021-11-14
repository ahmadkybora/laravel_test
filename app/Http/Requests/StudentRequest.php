<?php

namespace App\Http\Requests;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST' :
                return [
                    'lessonId' => ['required', 'exists:lessons,id'],
                    'score' => ['required']
                ];
            break;
        }
    }
}
