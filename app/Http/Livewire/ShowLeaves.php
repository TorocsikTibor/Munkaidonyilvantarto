<?php

namespace App\Http\Livewire;

use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowLeaves extends Component
{

    public function audit($id, $type) {
        switch($type) {
            case 'decline':
                return Leave::find($id)->update([
                    'status' => 'declined',
                ]);

            case 'accept':

                $leaveData = Leave::find($id);
                $user = User::find($leaveData->users_id);

                if($user->leave_number < 0) {
                    session()->flash('message', 'Nincs több szabadság.');
                    return 0;
                }

                $start = Carbon::createFromFormat('Y-m-d',$leaveData->start);
                $end = Carbon::createFromFormat('Y-m-d',$leaveData->end);

                $usedLeaves = $start->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                }, $end);
                $usedLeaves++;

                if($user->leave_number - $usedLeaves < 0) {
                    session()->flash('message', 'Nincs elég szabadság.');
                    return 1;
                }

                $user->leave_number -= $usedLeaves;
                $user->save();

                return Leave::find($id)->update([
                    'status' => 'accepted',
                ]);

            case 'withdrawn':
                return Leave::find($id)->update([
                    'status' => 'withdrawn',
                ]);
        }
    }

    public function render()
    {
        if(Auth::user()->can('manager')) {
            return view('livewire.show-leaves', [
                'leave' => Leave::with('Users:id,name')->get()
            ]);
        } else {
            return view('livewire.show-leaves', [
                'leave' => Leave::where('users_id' ,Auth::id())->with('Users:id,name')->get()
            ]);
        }
    }

}
