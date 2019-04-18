<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        try
        {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            Auth::login($this->create($request->all()));

            $message = response()->json([
                'success' => true,
                'msg' => "Welcome to Pick6, $request->first_name!"
            ]);
        }
        catch (\Exception $e)
        {
            $message = response()->json([
                'success' => false,
                'msg' => implode("<br />",$validator->messages()->all()),
                'fields' => $validator->messages()
            ]);

        }
        return $message;
    }
}
