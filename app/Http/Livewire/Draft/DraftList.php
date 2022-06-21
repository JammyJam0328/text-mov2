<?php

namespace App\Http\Livewire\Draft;

use Livewire\Component;
use App\Models\{Message,Department,Phonebook,Send,Receiver,Attachement};
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Humans\Semaphore\Laravel\Facades;
use GuzzleHttp\Client;
class DraftList extends Component
{
    use WithPagination,WithFileUploads, Actions;
    public $search='';
    public $view=false;
    public $view_details;
    public $expected_receivers=[];


    public function render()
    {
        return view('livewire.draft.draft-list',[
            'drafts' => Message::where('status','2')
                                ->where('body','like','%'.$this->search.'%')
                                ->with(['sends'])
                                ->latest()->paginate(10)
        ]);
    }

    public function view($id)
    {
        $this->view_details = Message::where('id',$id)->with(['receivers'])->first();
        $this->view = true;
    }

    public function clickResendHandler()
    {
        $this->expected_receivers = Phonebook::whereIn('id',$this->view_details->receivers->pluck('department_id'))->get();
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Are you sure you want to resend this message?',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, continue',
                'method' => 'resendHandler',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
        
    }

    public function resendHandler()
    {
        foreach ($this->expected_receivers as $exprected_receiver) {
            $send_message = Send::create([
                'phonebook_id' => $exprected_receiver->id,
                'message_id' => $this->view_details->id,
                'status' => 'pending',
            ]);

            $this->sendMessage($exprected_receiver->contact_number,$this->view_details->body);

            $send_message->update([
                'status' => 'sent',
            ]);
        }

        $this->view_details->update([
            'status' => '1',
        ]);
        $this->notification([
            'title' => 'Success',
            'description' => 'Message sent successfully',
            'icon' => 'success',
        ]);

        $this->view = false;
    }

    public function sendMessage($contact_number,$body)
    {
        $api_key = env('SEMAPHORE_API_KEY');
        $sender = "SEMAPHORE";
        $ch = curl_init();
        $parameters = array(
                'apikey' => $api_key, 
                'number' => $contact_number,
                'message' => $body,
                'sendername' => $sender,
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);
        return $output;
    }
}
