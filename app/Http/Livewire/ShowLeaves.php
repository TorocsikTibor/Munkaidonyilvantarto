<?php

namespace App\Http\Livewire;

use App\Models\Leave;
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
        return view('livewire.show-leaves', [
            'leave' => Leave::with('Users:id,name')->get()
        ]);
    }

}
