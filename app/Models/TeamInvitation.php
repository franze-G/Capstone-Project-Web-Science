<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamInvitation extends Model
{
    protected $fillable = [
        'team_id',
        'team_name',
        'team_user_id',
        'team_user_firstname',
        'team_user_lastname',
        'user_id',
        'user_firstname',
        'user_lastname',
        // new columns sa table kaya need idagdag sa fillable
        'email',
        'role',
    ];

    /**
     * Get the team that the invitation belongs to.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the user who is invited.
     */
    public function invitedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the owner of the team.
     */
    public function teamOwner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'team_user_id');
    }

    public function sendInvitation($teamId, $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Handle case where user doesn't exist
            return false;
        }

        $invitation = new TeamInvitation();
        $invitation->team_id = $teamId;
        $invitation->team_user_id = auth()->id(); // Assuming current user is sending the invitation
        $invitation->team_user_firstname = auth()->user()->firstname;
        $invitation->team_user_lastname = auth()->user()->lastname;
        $invitation->user_id = $user->id;
        $invitation->user_firstname = $user->firstname;
        $invitation->user_lastname = $user->lastname;
        $invitation->email = $email;
        $invitation->save();

        return true;
    }
}
