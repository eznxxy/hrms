<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLogoRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function update(Profile $profile, UpdateProfileRequest $request)
    {
        $data = $request->validated();

        $profile->update($data);

        return response()->json([
            'message' => __('Success, company profile has been updated.')
        ]);
    }

    public function updateLogo(Profile $profile, UpdateLogoRequest $request)
    {
        $data = $request->validated();

        if ($request->has('logo')) {
            if (!$request->file('logo')->storePublicly($profile->getLogoPath(), ['disk' => 'public'])) {
                abort(500, __("Image couldn't be saved, please try again"));
            }

            $data['logo'] = $request->file('logo')->hashName();
        }

        $profile->update($data);

        return response()->json([
            'message' => __('Success, company logo has been updated.')
        ]);
    }
}
