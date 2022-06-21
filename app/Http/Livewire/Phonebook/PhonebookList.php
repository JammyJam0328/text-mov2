<?php

namespace App\Http\Livewire\Phonebook;

use Livewire\Component;
use App\Models\Phonebook;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PhonebookImport;
;
class PhonebookList extends Component
{
    use WithPagination, Actions, WithFileUploads;
    public $search='';
    public $create=false;
    public $edit=false;
    public $importing=false;
    public $name,$phone_number,$department_id,$year_level;
    public $edit_name,$edit_phone_number,$edit_department_id,$edit_year_level;
    public $selected_phonebook;
    public $csv_file;
    public $selecteds=[];
    public $selectAll;
    protected $validationAttributes = [
        'department_id' => 'department',

    ];
    public function render()
    {
        return view('livewire.phonebook.phonebook-list',[
            'phonebooks' => Phonebook::where('name','like','%'.$this->search.'%')
                                        ->orWhere('contact_number','like','%'.$this->search.'%')
                                        ->with(['department'])
                                        ->paginate(10)
        ]);
    }

    public function clickCreateHandler()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits:11|unique:phonebooks,contact_number',
            'department_id' => 'required|integer',
            'year_level' => 'required|in:1,2,3,4,5,6',
        ]);
        Phonebook::create([
            'name' => $this->name,
            'contact_number' => $this->phone_number,
            'department_id' => $this->department_id,
            'year_level' => $this->year_level,
        ]);
        $this->reset([
            'name',
            'phone_number',
            'department_id',
            'year_level',
        ]);
        $this->notification([
            'title' => 'Success',
            'description' => 'Phonebook created successfully',
            'icon' => 'success',
        ]);
        $this->create=false;
    }

    public function clickEditHandler($id)
    {
        $this->edit=true;
        $this->selected_phonebook = Phonebook::where('id',$id)->first();
        $this->edit_name = $this->selected_phonebook->name;
        $this->edit_phone_number = $this->selected_phonebook->contact_number;
        $this->edit_department_id = $this->selected_phonebook->department_id;
        $this->edit_year_level = $this->selected_phonebook->year_level;
    }

    public function clickUpdateHandler()
    {
        $this->validate([
            'edit_name' => 'required|string|max:255',
            'edit_phone_number' => 'required|numeric|digits:11|unique:phonebooks,contact_number,'.$this->selected_phonebook->id,
            'edit_department_id' => 'required|integer',
            'edit_year_level' => 'required|in:1,2,3,4,5,6',
        ]);

        $this->selected_phonebook->update([
            'name' => $this->edit_name,
            'contact_number' => $this->edit_phone_number,
            'department_id' => $this->edit_department_id,
            'year_level' => $this->edit_year_level,
        ]);
        $this->reset([
            'edit_name',
            'edit_phone_number',
            'edit_department_id',
            'edit_year_level',
        ]);
        $this->notification([
            'title' => 'Success',
            'description' => 'Phonebook updated successfully',
            'icon' => 'success',
        ]);
        $this->edit=false;
    }

    public function clickDeleteHandler($id)
    {
        $this->selected_phonebook = Phonebook::where('id',$id)->first();
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'You are about to delete this phonebook',
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
        $this->selected_phonebook->delete();
        $this->notification([
            'title' => 'Success',
            'description' => 'Phonebook deleted successfully',
            'icon' => 'success',
        ]);
    }

    public function clickImportHandler()
    {
        $this->validate([
            'csv_file' => 'required|mimes:csv,xlsx,xls',
        ]);
        Excel::import(new PhonebookImport,$this->csv_file);
        $this->notification([
            'title' => 'Success',
            'description' => 'Phonebook imported successfully',
            'icon' => 'success',
        ]);
        $this->importing=false;
    }

    public function updatedSelectAll()
    {
        if($this->selectAll){
            $this->selecteds = Phonebook::pluck('id')->toArray();
        }else{
            $this->selecteds = [];
        }
    }

    public function deleteSelecteds()
    {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'You are about to delete selected phonebooks',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, Delete it',
                'method' => 'confirmDeleteSelectedsHandler',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function confirmDeleteSelectedsHandler()
    {
        Phonebook::destroy($this->selecteds);
        $this->notification([
            'title' => 'Success',
            'description' => 'Phonebooks deleted successfully',
            'icon' => 'success',
        ]);
        $this->selectAll=false;
        $this->selecteds = [];
    }

    
}
