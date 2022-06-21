<?php

namespace App\Http\Livewire\Message;

use Livewire\Component;
use App\Models\{Message,Department,Phonebook,Send,Receiver,Attachement};
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Humans\Semaphore\Laravel\Facades;
use GuzzleHttp\Client;
class MessageList extends Component
{
    use WithPagination,WithFileUploads, Actions;
    public $search='';
    public $filter='';
    public $create=false;
    public $edit=false;
    public $view=false;
    public $balance;
    public $view_details;
    public $body,$receivers=[],$exprected_receivers=[],$attachments=[];

    public $departments=[];
    public function mount()
    {
        $this->departments=Department::all();
    }
    public function getBalance()
    {
        $api_key = env('SEMAPHORE_API_KEY');
        $client = new Client();
        try {
            $response = $client->request('GET', 'https://semaphore.co/api/v4/account?apikey='.$api_key);
            $body = $response->getBody();
            $this->balance =  json_decode($body);
            $this->balance = $this->balance->credit_balance;
            $this->notification([
                'title' => 'Success',
                'description' => 'Current Balance is '.$this->balance,
                'icon' => 'info',
            ]);
        } catch (\Throwable $th) {
            $this->notification([
                'title' => 'Error',
                'description' => 'Please try again after 2 minutes',
                'icon' => 'error',
            ]);
        }
    }
    public function render()
    {
        return view('livewire.message.message-list',[
            'messages' => Message::where('status','like','%'.$this->filter.'%')
                                ->where('body','like','%'.$this->search.'%')
                                ->where('status','1')
                                ->orWhere('sender','like','%'.$this->search.'%')
                                ->with(['sends'])
                                ->latest()->paginate(10)
        ]);
    }

    public function clickSendHandler()
    {
        $this->validate([
            'body' => 'required|string|max:255',
            'receivers' => 'required',
            'attachments' => 'required',
        ]);
        $this->exprected_receivers = Phonebook::whereIn('department_id',$this->receivers)->get();
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'You are about to send this message',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, continue',
                'method' => 'continueSendHandler',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function continueSendHandler()
    {
        $message = Message::create([
            'body' => $this->body,
            'sender' => auth()->user()->name,
            'status' => '0',
        ]);
        foreach ($this->attachments as $key => $file) {
            Attachement::create([
                'message_id' => $message->id,
                'path' => $file->store('attachments','public'),
            ]);
        }
        foreach($this->receivers as $receiver){
            Receiver::create([
                'message_id' => $message->id,
                'department_id' => $receiver,
            ]);
        }
        foreach ($this->exprected_receivers as $exprected_receiver) {
            $send_message = Send::create([
                'phonebook_id' => $exprected_receiver->id,
                'message_id' => $message->id,
                'status' => 'pending',
            ]);

            $this->sendMessage($exprected_receiver->contact_number,$this->body);

            $send_message->update([
                'status' => 'sent',
            ]);
        }
        $message->update([
            'status' => '1',
        ]);

        $this->reset([
            'body',
            'receivers',
            'attachments',
        ]);
        $this->notification([
            'title' => 'Success',
            'description' => 'Message sent successfully',
            'icon' => 'success',
        ]);

        $this->create=false;
    }

    public function select($id)
    {
        if(in_array($id,$this->receivers)){
            $key = array_search($id,$this->receivers);
            unset($this->receivers[$key]);
        }else{
            $this->receivers[]=$id;
        }
    }

    public function sendAsDraft()
    {
        $this->validate([
            'body' => 'required|string|max:255',
            'receivers' => 'required',
            'attachments' => 'required',
        ]);
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'You are about to save as draft this message',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, continue',
                'method' => 'continueSendAsDraftHandler',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function continueSendAsDraftHandler()
    {
        $message = Message::create([
            'body' => $this->body,
            'sender' => auth()->user()->name,
            'status' => '2',
        ]);
        foreach ($this->attachments as $key => $file) {
            Attachement::create([
                'message_id' => $message->id,
                'path' => $file->store('attachments','public'),
            ]);
        }
        foreach($this->receivers as $receiver){
            Receiver::create([
                'message_id' => $message->id,
                'department_id' => $receiver,
            ]);
        }
        $this->reset([
            'body',
            'receivers',
            'attachments',
        ]);
        $this->notification([
            'title' => 'Success',
            'description' => 'Message saved as draft successfully',
            'icon' => 'success',
        ]);
        $this->create=false;
    }

    public function view($id)
    {
        $this->view_details = Message::where('id',$id)
                                ->with(['sends','attachments'])
                                ->first();
        $this->view=true;
    }

    public function clickContinueHandler()
    {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'You are about to send this message',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, continue',
                'method' => 'continueHandler',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);

    }

    public function continueHandler()
    {
        $sends = Send::where('message_id',$this->view_details->id)  
                        ->where('status','pending')
                        ->with(['phonebook'])
                        ->get();
        foreach ($sends as $send) {
            // $semaphore = new SemaphoreMessage();
            // $semaphore->message()->send($send->phonebook->contact_number,$this->view_details->body);
            $this->sendMessage($send->phonebook->contact_number,$this->view_details->body);
            $send->update([
                'status' => 'sent',
            ]);
        }
        $this->view_details->update([
            'status' => '1',
        ]);
        $this->view=false;
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
