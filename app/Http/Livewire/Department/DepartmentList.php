<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
class DepartmentList extends Component
{   
    use WithPagination, Actions;
    public $name,$abbreviation;
    public $edit_name,$edit_abbreviation;
    public $search='';
    public $create=false;
    public $edit=false;
    public $selected_department;
    protected $validationAttributes = [
        'edit_name' => 'Name',
        'edit_abbreviation' => 'Abbreviation',
    ];
    public function render()
    {
        return view('livewire.department.department-list',[
            'departments' => Department::where('name','like','%'.$this->search.'%')->orWhere('abbreviation','%'.$this->search.'%')->paginate(10)
        ]);
    }

    public function clickCreateHandler()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:255',
        ]);
        Department::create([
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
        ]);
        $this->reset([
            'name',
            'abbreviation',
        ]);
        $this->notification([
            'title' => 'Success',
            'description' => 'Department created successfully',
            'icon' => 'success',
        ]);
        $this->create=false;
    }

    public function clickEditHandler($id)
    {
        $this->edit=true;
        $this->selected_department = Department::where('id',$id)->first();
        $this->edit_name= $this->selected_department ->name;
        $this->edit_abbreviation= $this->selected_department ->abbreviation;
    }

    public function clickUpdateHandler()
    {
        $this->validate([
            'edit_name' => 'required|string|max:255',
            'edit_abbreviation' => 'required|string|max:255',
        ]);
        $this->selected_department->update([
            'name' => $this->edit_name,
            'abbreviation' => $this->edit_abbreviation,
        ]);
        $this->reset([
            'edit_name',
            'edit_abbreviation',
        ]);
        $this->notification([
            'title' => 'Success',
            'description' => 'Department updated successfully',
            'icon' => 'success',
        ]);
        $this->edit=false;
    }

    public function clickDeleteHandler($id)
    {
        $this->selected_department = Department::where('id',$id)->first();
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'You are about to delete this department',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, Delete it',
                'method' => 'confirmDeleteHandler',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function confirmDeleteHandler()
    {
        $this->selected_department->delete();
        $this->notification([
            'title' => 'Success',
            'description' => 'Department deleted successfully',
            'icon' => 'success',
        ]);
    }
}
