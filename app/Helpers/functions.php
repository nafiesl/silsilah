<?php

use App\DescendantEnum;
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

/**
 * Create family tree for specified user.
 *
 * @param User $user
 * @return string
 */
function createFamilyTree(User $user) {
    $linkToRoute = link_to_route('users.tree', $user->name, [$user->id], ['title' => $user->name.' ('.$user->gender.')']);
    $header = <<<HTML
<span class="label">$linkToRoute</span>
HTML;

    $createFamilyTree = function ($user, User $parent = null, $level = 1) use (&$createFamilyTree) {
        $linkToRoute = link_to_route('users.tree', $user->name, [$user->id], ['title' => $user->name.' ('.$user->gender.')']);
        $basicHeader = <<<HTML
<span class="label">$linkToRoute</span>
HTML;

        $soleString = "";
        if ($parent && $parent->childs->count() === 1) {
            $soleString = "sole";
        }

        $header = <<<HTML
<div class="entry $soleString">
    $basicHeader
HTML;
        $childContainer = "";

        if ($user->childs->count() !== 0 ) {
            $nextLevel = $level + 1;
            $childContainer = "<div class=\"branch lv$nextLevel\">";
            foreach ($user->childs as $child) {
                $childContainer .= $createFamilyTree($child, $user, $nextLevel);
            }
            $childContainer .= "</div>";
        }

        $footer = <<<HTML
</div>
HTML;

        return $header . $childContainer . $footer;
    };

    $childContainer = <<<HTML
    <div class="branch lv1">
HTML;
    foreach ($user->childs as $child) {
        $childContainer .= $createFamilyTree($child, $user, 1);
    }
    $childContainer .= <<<HTML
    </div>
HTML;

    return $header . $childContainer;
}

function showFamilyTreeCount(User $user, $limit = -1)
{
    $userDescendantClass = new ReflectionClass(DescendantEnum::class);
    $descendantString = array_flip($userDescendantClass->getConstants());

    if(!$user) {
        return "";
    }

    $descendantCounts = $user->getChildCount($limit);

    $result = "";
    foreach ($descendantCounts as $key => $descendantCount) {
        if ($descendantCount === 0) {
            break;
        }

        $currentDescendantString = ucfirst(strtolower($descendantString[$key]));
        $result .= <<<HTML
<div class="col-md-1 text-right">Jumlah $currentDescendantString</div>
<div class="col-md-1 text-left"><strong style="font-size:30px">$descendantCount</strong></div>
HTML;

    }

    return $result;
}
