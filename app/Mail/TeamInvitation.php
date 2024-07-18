<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TeamInvitation as TeamInvitationModel;

class TeamInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;
    public $acceptUrl;

    public function __construct(TeamInvitationModel $invitation, string $acceptUrl)
    {
        $this->invitation = $invitation;
        $this->acceptUrl = $acceptUrl;
    }
 /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.team-invitation')
                    ->with([
                        'invitation' => $this->invitation,
                        'acceptUrl' => $this->acceptUrl,
                    ]);
    }
}
