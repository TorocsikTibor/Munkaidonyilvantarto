<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LeaveController extends Controller
{
    public function index(){
        return view('makeleave');
    }

    public function saveData(Request $request) {

        $leave = new Leave;
        $leave->type = $request->input('type');
        $leave->start = $request->input('start');
        $leave->end = $request->input('end');
        $leave->desc = $request->input('desc');
        $leave->users_id = Auth::user()->id;


        $start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $request->input('end'));
        $userLeave = User::find($leave->users_id);

        $usedLeaves = $start->diffInDaysFiltered(function(Carbon $date) {
            return !$date->isWeekend();
        }, $end);
        $usedLeaves++;


        if ($request->input('action') === 'Draft') {
            $leave->status = 'draft';
        } else {
            $leave->status = 'waiting_for_approval';
        }

        if ($request->input('type') == 2) {
            $leave->status = 'accepted';

            $userLeave->sick_leave += $usedLeaves;
            $userLeave->save();
        }


        if($userLeave->leave_number < 0) {
            session()->flash('message', 'Nincs több szabadság.');
            return 0;
        }

        if($userLeave->leave_number - $usedLeaves < 0) {
            session()->flash('message', 'Nincs elég szabadság.');
            return 1;
        }
        $leave->save();

        return redirect('leave');
    }

    public function listLeave() {
        return view('test');
    }

    public function getLeave($id){
        $data['leaves'] = NULL;
    }
}
