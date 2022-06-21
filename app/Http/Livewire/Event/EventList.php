<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;
use App\Models\Event;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
class EventList extends Component
{
    use WithPagination, Actions;
    public $search='';
    public $create=false;
    public $edit=false;
    public $title,$description,$start_date,$end_date;
    public $edit_title,$edit_description,$edit_start_date,$edit_end_date;
    public $filter='';
    public $selected_event;
    public function render()
    {
        return view('livewire.event.event-list',[
            'events' => Event::where('status','like','%'.$this->filter.'%')->where('description','like','%'.$this->search.'%')->latest()->paginate(10)
        ]);
    }

    public function clickCreateHandler()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Event::create([
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => '0',
        ]);

        $this->reset([
            'title',
            'description',
            'start_date',
            'end_date',
        ]);

        $this->notification([
            'title' => 'Success',
            'description' => 'Event created successfully',
            'icon' => 'success',
        ]);

        $this->create=false;
    }

    public function clickMarkAsCompleteHandler($id)
    {
        $this->selected_event = Event::where('id',$id)->first();
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'You are about to mark this event as complete',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, Mark as Complete',
                'method' => 'confirmMarkAsComplete',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function confirmMarkAsComplete()
    {
        $this->selected_event->update([
            'status' => '1',
        ]);
        $this->notification([
            'title' => 'Success',
            'description' => 'Event marked as complete successfully',
            'icon' => 'success',
        ]);
    }
}
