<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TeamInvitation; // Ensure this matches your actual model location

class TeamInviteController extends Controller
{

    // function nito is mag display ng mga invites
    public function index()
    {
        // Retrieve all team invitations for the authenticated user
        $invitations = Auth::user()->teamInvitations;

        return view('teams.team-invitation', compact('invitations'));
    }

    //for accept function
    public function accept($id)
    {
        // Fetch the invitation by ID
        $invitation = TeamInvitation::findOrFail($id);

        // Handle the acceptance logic here
        // Add the user to the team
        $invitation->team->users()->attach(Auth::id(), ['role' => $invitation->role]);

        // Optionally, you can delete the invitation after acceptance
        $invitation->delete();

        return redirect()->route('team.invite')->with('status', 'Invitation accepted.');
    }

    // pag dineclined deleted invite lang sa freelance tapos client. di ko na nilagyan status
    public function destroy($id)
    {
        // Fetch the invitation by ID
        $invitation = TeamInvitation::findOrFail($id);
    
        // Delete the invitation
        $invitation->delete();
    
        return redirect()->route('team.invite')->with('status', 'Invitation declined and deleted.');
    }
    
}

