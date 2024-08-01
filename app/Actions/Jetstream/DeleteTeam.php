<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use Illuminate\Support\Facades\DB;

class DeleteTeam
{
    /**
     * Delete the given team.
     *
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function delete(Team $team, $deleter): void
    {
        DB::transaction(function () use ($team) {
            // Perform the deletion
            $team->delete();
        });
    }
    /**
     * Archive the given team.
     *
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function archive(Team $team): void
    {
        $team->update(['archived' => true]);
    }
}