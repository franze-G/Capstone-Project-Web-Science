<?php

namespace App\Actions\Jetstream;

use App\Models\Team;

class DeleteTeam
{
    /**
     * Delete the given team.
     *
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function delete(Team $team): void
    {
        $team->delete();
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
