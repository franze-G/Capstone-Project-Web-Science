<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Create a new action instance.
     *
     * @param \Laravel\Jetstream\Contracts\DeletesTeams $deletesTeams
     */
    // public function __construct(protected DeletesTeams $deletesTeams)
    // {
    // }

    /**
     * Delete the given user.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->deleteTeams($user);
            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();
        });
    }

    /**
     * Delete the teams and team associations attached to the user.
     *
     * @param \App\Models\User $user
     * @return void
     */
    protected function deleteTeams(User $user): void
    {
        $user->teams()->detach();

        $user->ownedTeams->each(function (Team $team) {
        });
    }
}
