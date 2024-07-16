<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Jetstream;

class CreateTeam implements CreatesTeams
{
    /**
     * Validate and create a new team for the given user.
     *
     * @param  User  $user
     * @param  array<string, string>  $input
     * @return Team
     */
    public function create(User $user, array $input): Team
    {
        // Authorize the user to create a new team
        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        // Validate the input data
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createTeam');

        // Dispatch the event for adding a team
        AddingTeam::dispatch($user);

        // Create the new team
        $team = $user->ownedTeams()->create([
            'name' => $input['name'],
            'personal_team' => false,

            // itoyung need para mafetch yung name ng owner. which is idadagdag sa fillables ng team.php na nasa model.
            'user_firstname' => $user->firstname, 
            'user_lastname' => $user->lastname// Ensure this field is populated
        ]);

        // Switch the user to the newly created team
        $user->switchTeam($team);

        return $team;
    }
}
