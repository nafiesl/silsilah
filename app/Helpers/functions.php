<?php

use App\User;

/**
 * Convert file size to have unit string.
 *
 * @param  int  $bytes
 * @return string
 */
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2).' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2).' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2).' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes.' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes.' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

/**
 * Get user photo image tag.
 *
 * @param  \App\User  $user
 * @param  array  $attributes
 * @return \Illuminate\Support\HtmlString
 */
function userPhoto(User $user, $attributes = [])
{
    return Html::image(
        userPhotoPath($user->photo_path, $user->gender_id),
        null,
        $attributes
    );
}

/**
 * Get user photo by path. Return default gender icon by default.
 *
 * @param  string  $photoPath
 * @param  int  $genderId
 * @return string
 */
function userPhotoPath($photoPath, $genderId)
{
    if (is_file(public_path('storage/'.$photoPath))) {
        return asset('storage/'.$photoPath);
    }

    return asset('images/icon_user_'.$genderId.'.png');
}

function is_system_admin(User $user)
{
    if ($user->email) {
        if (config('app.system_admin_emails')) {
            $adminEmails = explode(';', config('app.system_admin_emails'));
            return in_array($user->email, $adminEmails);
        }
    }

    return false;
}
