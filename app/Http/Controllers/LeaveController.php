<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function saveData(Request $request) {

        $leave = new Leave;
        $leave->type = $request->input('type');
        $leave->start = $request->input('start');
        $leave->end = $request->input('end');
        $leave->desc = $request->input('desc');
        $leave->users_id = Auth::user()->id;

        if ($request->input('action') === 'Draft') {
            $leave->status = 'draft';
        } else {
            $leave->status = 'waiting_for_approval';
        }

        $leave->save();

        return view('test');
    }

    public function listLeave() {
        return view('test', [
            'leave' => Leave::with('Users:id,name')->get()
        ]);
    }

    public function getLeave($id){
        $data['leaves'] = NULL;
    }
}
