<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\Events\AddingTeamMember;
use Laravel\Jetstream\Events\TeamMemberAdded;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Rules\Role;

class AddTeamMember implements AddsTeamMembers
{
    /**
     * Add a new team member to the given team.
     */
    public function add(User $user, Team $team, string $email, ?string $role = null): void
    {
        // Authorize the user to add a team member
        Gate::forUser($user)->authorize('addTeamMember', $team);

        // Validate the input
        $this->validate($team, $email, $role);

        // Find the user by email
        $newTeamMember = Jetstream::findUserByEmailOrFail($email);

        // Dispatch the event for adding a team member
        AddingTeamMember::dispatch($team, $newTeamMember);

        // Attach the user to the team with the specified role
        $team->users()->attach(
            $newTeamMember->id, [

                // same syntax sa creating ng team. need idagdag yung tatlong fillables which is firstname, lastname and teams name. yung team name wala sya fillable ng team.php kasi ifefetch lang sya from team table.
                'user_firstname' => $newTeamMember->firstname, // Include firstname
                'user_lastname' => $newTeamMember->lastname,   // Include lastname
                'team_name' => $team->name, // Include team name
                'role' => $role
            ]
        );

        // Dispatch the event for a team member added
        TeamMemberAdded::dispatch($team, $newTeamMember);
    }

    /**
     * Validate the add member operation.
     */
    protected function validate(Team $team, string $email, ?string $role): void
    {
        Validator::make([
            'email' => $email,
            'role' => $role,
        ], $this->rules(), [
            'email.exists' => __('We were unable to find a registered user with this email address.'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnTeam($team, $email)
        )->after(
            $this->ensureUserIsFreelancer($email)
        )->validateWithBag('addTeamMember');
    }

    /**
     * Get the validation rules for adding a team member.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function rules(): array
    {
        return array_filter([
            'email' => ['required', 'email', 'exists:users,email'],
            'role' => Jetstream::hasRoles()
                            ? ['required', 'string', new Role]
                            : null,
        ]);
    }

    /**
     * Ensure that the user is not already on the team.
     */
    protected function ensureUserIsNotAlreadyOnTeam(Team $team, string $email): Closure
    {
        return function ($validator) use ($team, $email) {
            $validator->errors()->addIf(
                $team->hasUserWithEmail($email),
                'email',
                __('This user already belongs to the team.')
            );
        };
    }

    /**
     * Ensure that the user has the role of freelancer.
     */
    protected function ensureUserIsFreelancer(string $email): Closure
    {
        return function ($validator) use ($email) {
            if (!$this->isFreelancer($email)) {
                $validator->errors()->add('email', __('Only freelancers can be added as team members.'));
            }
        };
    }

    /**
     * Check if the user is a freelancer.
     */
    protected function isFreelancer(string $email): bool
    {
        $user = User::where('email', $email)->first();
        return $user && $user->role === 'freelancer';
    }
}
