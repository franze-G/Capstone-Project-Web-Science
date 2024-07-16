<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',

        // ito yung dinagdag na fillables since meron na syang column sa migration. basically every column need may fillable kasi mag papasok ng data. 

        'user_firstname',
        'user_lastname',
// Include the user_firstname field
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_team' => 'boolean',
            // Add other casts if necessary
        ];
    }

    /**
     * Get the owner of the team.
     */

     // ifefetch yung user_id from users table para malaman yung firstname and lastname ng owner.
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
