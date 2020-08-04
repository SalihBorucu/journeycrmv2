<?php

namespace App\Http\Controllers;

use App\GlobalLeadNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GlobalLeadNotesController extends Controller
{
    public function create(){
        $note = GlobalLeadNotes::create([
            'lead_id' => request('lead')['id'],
            'user_id' => Auth::id(),
            'note' => request('global_note'),
            'score' => request('score'),
        ]);

        $noteWithUser = GlobalLeadNotes::with(['user'])->find($note->id);

        return response()->json($noteWithUser);
    }
}
