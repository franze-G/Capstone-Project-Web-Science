<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'role',
        'position',
        'email',
        'password',
        'star_rating'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //ito yung need para madetermine yung function ng dynamic page and navigation menu

    public function isClient()
    {
        return $this->role === 'client'; // Adjust this to your role implementation
    }

    public function isFreelancer()
    {
        return $this->role === 'freelancer'; // Adjust this to your role implementation
    }

    //ito for displaying ng current team ng user and client. belongs to many ibig sabihin galing sya from different table. "team"table name "user" column name.

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user', 'user_id', 'team_id')->withPivot('user_firstname','user_lastname','team_name', 'role');
    }

    public function teamInvitations()
    {
        return $this->hasMany(TeamInvitation::class, 'email', 'email');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_id');
    }

       /**
     * Get the projects assigned to the user.
     */
    public function assignedProjects()
    {
        return $this->hasMany(Project::class, 'assigned_id');
    }

    /**
     * Get the projects created by the user.
     */
    public function createdProjects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    public function allProjects()
    {
        return $this->createdProjects->merge($this->assignedProjects);
    }
}
