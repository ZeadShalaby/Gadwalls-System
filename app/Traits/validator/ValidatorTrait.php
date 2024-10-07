<?php
namespace App\Traits\validator;

use Exception;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator; // Add this import

trait ValidatorTrait
{
    use ResponseTrait;

    //todo check validate done or not
    public function validate($request, array $rules, array $messages = [], array $attributes = [])
    {

        // ! valditaion
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        return true;

    }



    // todo return info user with media 
    protected function mediaAuth()
    {
        $user = User::find(auth()->user()->id)
            ->load([
                'media_one' => function ($query) {
                    $query->limit(1); //? Limit to 1 media item
                }
            ]);
        return $user;
    }



}