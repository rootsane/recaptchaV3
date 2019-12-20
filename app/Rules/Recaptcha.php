<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class Recaptcha implements Rule
{
    /**
     * @var float
     */
    private $_score;

    /**
     * Create a new rule instance.
     *
     * @param float $_score
     */
    public function __construct($_score = 0.5)
    {
        $this->_score = $_score;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $client = new Client();
        if (App::environment(['production']))
        {
            $response = $client->request('POST', env('GOOGLE_RECAPTCHA_URL'), [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $value
                ]
            ]);

        }else{
            $response = $client->request('POST', env('GOOGLE_RECAPTCHA_URL'), [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SECRET_LOCAL_KEY'),
                    'response' => $value
                ]
            ]);

        }

        $results = json_decode($response->getBody(), true);

        return ($results['success'] && $results['score'] > $this->_score);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return config('errorMessage.botError');
    }
}
