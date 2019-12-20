<?php

namespace App\Http\Requests\Tmp;

use App\Rules\Recaptcha;
use App\Services\JsonResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class TmpRequest extends FormRequest
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
        $_score = 0.5;
        return [
            'tmp_id' => config('validationRules.tmp_id'),
            'tmp_password' => config('validationRules.tmp_id'),
            'recaptcha_response' => new Recaptcha($_score),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'tmp_id.required' => config('errorMessage.requiredUserID'),
            'tmp_password.required' => config('errorMessage.requiredPassword'),

        ];
    }
    /**
     * @param Validator $validator
     */
    protected function failedValidation( Validator $validator)
    {
        $response = array();
        $response = array_merge($response, array('resultCode' => 0));
        $response = array_merge($response, array('resultMsg' => 'validateError'));
        $response = array_merge($response, array('contents' => $validator->errors()->toArray()));
        $json = json_encode($response);
        http_response_code(200);
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,  X-CSRF-TOKEN');
        header('Access-Control-Allow-Origin: *');
        header('Cache-Control: no-cache');
        header('Content-Type: application/json');
        header('Content-Length: '.strlen($json));
        echo $json;
        exit();
    }
}
