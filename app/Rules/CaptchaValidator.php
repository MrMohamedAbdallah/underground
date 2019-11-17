<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use GuzzleHttp\Client;


class CaptchaValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $res = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('re_private'),
                'response' => $value
            ]
        ]);

        // Body
        $body = json_decode($res->getBody());

        // Return wheather it's succeded or not
        return $body->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please check the recaptch box.';
    }
}
