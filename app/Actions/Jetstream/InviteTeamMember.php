<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use App\Models\TeamInvitation as TeamInvitationModel;
use Closure;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Contracts\InvitesTeamMembers;
use Laravel\Jetstream\Events\InvitingTeamMember;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Rules\Role;
use App\Mail\TeamInvitation as TeamInvitationMail;

class InviteTeamMember implements InvitesTeamMembers
{
    public function invite(User $user, Team $team, string $email, ?string $role = null): void
    {
        Gate::forUser($user)->authorize('addTeamMember', $team);

        $this->validate($team, $email, $role);

        InvitingTeamMember::dispatch($team, $email, $role);

        $invitation = TeamInvitationModel::create([
            'team_id' => $team->id,
            'team_name' => $team->name,
            'team_user_id' => $team->owner->id,
            'team_user_firstname' => $team->owner->firstname,
            'team_user_lastname' => $team->owner->lastname,
            'user_id' => $user->id,
            // ito yung pang fetch ng mga info from team_invitation table
            'email' => $email,
            'role' => $role,
        ]);

        $acceptUrl = url('/team-invitation/accept/' . $invitation->id);

        Mail::to($email)->send(new TeamInvitationMail($invitation, $acceptUrl));
    }

    protected function validate(Team $team, string $email, ?string $role): void
    {
        Validator::make([
            'email' => $email,
            'role' => $role,
        ], $this->rules($team), [
            'email.unique' => __('This user has already been invited to the team.'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnTeam($team, $email)
        )->after(
            $this->ensureUserIsFreelancer($email)
        )->validateWithBag('addTeamMember');
    }

    protected function rules(Team $team): array
    {
        return array_filter([
            'email' => [
                'required', 'email',
                Rule::unique('team_invitations')->where(function (Builder $query) use ($team) {
                    $query->where('team_id', $team->id);
                }),
            ],
            'role' => Jetstream::hasRoles()
                ? ['required', 'string', new Role]
                : null,
        ]);
    }

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

    protected function ensureUserIsFreelancer(string $email): Closure
    {
        return function ($validator) use ($email) {
            // Check if the email exists in the users table
            $userExists = User::where('email', $email)->exists();

            if (!$userExists) {
                $validator->errors()->add('email', __('This email does not exist.'));
                return;
            }

            // Check if the email belongs to a freelancer
            if (!$this->isFreelancer($email)) {
                $validator->errors()->add('email', __('Only freelancers can be invited as team members.'));
            }
        };
    }


    protected function isFreelancer(string $email): bool
    {
        $user = User::where('email', $email)->first();
        return $user && $user->role === 'freelancer'; //should be freelance wo r, check ko pa ibang code to verify if this causes error
    }
}
