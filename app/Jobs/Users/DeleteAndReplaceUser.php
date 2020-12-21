<?php

namespace App\Jobs\Users;

use App\Couple;
use App\User;
use Illuminate\Support\Facades\DB;

class DeleteAndReplaceUser
{
    public $user;

    public $replacementUserId;

    public function __construct(User $user, string $replacementUserId)
    {
        $this->user = $user;
        $this->replacementUserId = $replacementUserId;
    }

    public function handle()
    {
        $user = $this->user;
        $replacementUserId = $this->replacementUserId;

        DB::beginTransaction();
        $this->replaceUserOnUsersTable($user->id, $replacementUserId);
        $this->removeDuplicatedCouples($user->id, $replacementUserId);
        $this->replaceUserOnCouplesTable($user->id, $replacementUserId);
        $user->delete();
        DB::commit();
    }

    private function replaceUserOnCouplesTable($oldUserId, $replacementUserId)
    {
        DB::table('couples')->where('husband_id', $oldUserId)->update([
            'husband_id' => $replacementUserId,
        ]);
        DB::table('couples')->where('wife_id', $oldUserId)->update([
            'wife_id' => $replacementUserId,
        ]);
        DB::table('couples')->where('manager_id', $oldUserId)->update([
            'manager_id' => $replacementUserId,
        ]);
    }

    private function removeDuplicatedCouples(string $oldUserId, string $replacementUserId)
    {
        $oldUser = User::find($oldUserId);
        $replacementUser = User::find($replacementUserId);

        if ($replacementUser->gender_id == 1) {
            $replacementUserCouples = Couple::where('husband_id', $replacementUserId)->get();
        } else {
            $replacementUserCouples = Couple::where('wife_id', $replacementUserId)->get();
        }
        if ($oldUser->gender_id == 1) {
            $oldUserCouples = Couple::where('husband_id', $oldUserId)->get();
        } else {
            $oldUserCouples = Couple::where('wife_id', $oldUserId)->get();
        }

        $couplesArray = [];
        foreach ($replacementUserCouples as $replacementUserCouple) {
            $couplesArray[$replacementUserCouple->id] = $replacementUserCouple->husband_id.'_'.$replacementUserCouple->wife_id;
        }
        foreach ($oldUserCouples as $oldUserCouple) {
            $couplesArray[$oldUserCouple->id] = $oldUserCouple->husband_id.'_'.$oldUserCouple->wife_id;
        }
        $couplesArray = collect($couplesArray);
        $deletableCouples = [];
        if ($oldUser->gender_id == 1) {
            foreach ($oldUserCouples as $oldUserCouple) {
                $deletableCouples[] = $couplesArray->search($replacementUserId.'_'.$oldUserCouple->wife_id);
            }
        } else {
            foreach ($oldUserCouples as $oldUserCouple) {
                $deletableCouples[] = $couplesArray->search($oldUserCouple->husband_id.'_'.$replacementUserId);
            }
        }

        if ($deletableCouples) {
            Couple::whereIn('id', $deletableCouples)->delete();
        }
    }

    private function replaceUserOnUsersTable(string $oldUserId, string $replacementUserId)
    {
        foreach (['father_id', 'mother_id', 'manager_id'] as $field) {
            DB::table('users')->where($field, $oldUserId)->update([
                $field => $replacementUserId,
            ]);
        }
    }
}
