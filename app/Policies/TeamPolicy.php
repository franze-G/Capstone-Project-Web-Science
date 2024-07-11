<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user/client can view the team.
     *
     * @param  User|Client  $user
     * @param  Team  $team
     * @return bool
     */

    //  dito not sure sa function HAHHAHAHA
    public function view($user, Team $team)
    {
        return $user instanceof User || $user instanceof Client;
    }

    /**
     * Determine whether the user/client can create teams.
     *
     * @param  User|Client  $user
     * @return bool
     */
    public function create($user)
    {
        return $user instanceof User || $user instanceof Client;
    }

    /**
     * Determine whether the user/client can update the team.
     *
     * @param  User|Client  $user
     * @param  Team  $team
     * @return bool
     */
    public function update($user, Team $team)
    {
        return $user instanceof User || $user instanceof Client;
    }

    /**
     * Determine whether the user/client can delete the team.
     *
     * @param  User|Client  $user
     * @param  Team  $team
     * @return bool
     */
    public function delete($user, Team $team)
    {
        return $user instanceof User || $user instanceof Client;
    }

    // Other policy methods...
}
