<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Participant as User;

class Participant extends Component
{
    use WithPagination;

    public $modalVisible = false;
    public $action;

    public $participantId;
    public $fullName, $bussinessName, $email, $phone;

    public function openModal($action, $id = null)
    {
        switch ($action) {
            case in_array($action, ['create', 'edit']):
                $this->modalVisible = true;
                $this->action = $action;
                
                break;

            case 'delete':
                $this->modalVisible = true;
                $this->action = $action;
                $this->participantId = $id;
                
                break;
            
            default:
                return;
                break;
        }
    }

    public function closeModal()
    {
        $this->modalVisible = false;
        $this->confirmVisible = false;
        $this->resetVars();
    }

    public function resetVars()
    {
        $this->participantId = null;
        $this->fullName = null;
        $this->bussinessName = null;
        $this->email = null;
        $this->phone = null;
    }

    protected $rules = [
        'fullName' => 'required|min:6',
        'bussinessName' => 'required|min:6',
        'email' => 'required|email',
        'phone' => 'required|numeric',
    ];

    public function edit($id)
    {
        $participant = User::find($id);

        $this->participantId = $participant->id;
        $this->fullName = $participant->full_name;
        $this->bussinessName = $participant->bussiness_name;
        $this->email = $participant->email;
        $this->phone = $participant->phone;

        $this->openModal('edit');
    }


    public function saveData()
    {
        $validatedData = $this->validate();
        $data = [
            'full_name' => $validatedData['fullName'],
            'bussiness_name' => $validatedData['bussinessName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ];

        if ($this->participantId) {
            User::find($this->participantId)->update($data);
        } else {
            User::create($data);
        }
        
        session()->flash('message', 'Participant was successfully ' . ($this->participantId ? 'Edited' : 'Added') . '!');

        $this->closeModal();
    }

    public function destroy()
    {
        User::destroy($this->participantId);

        $this->closeModal();

        session()->flash('message', 'Participant was successfully removed!');
    }

    public function print($action, $id)
    {
        $data = User::find($id);

        switch ($action) {
            case 'certificate':
                $pdf = \PDF::loadView('pdf.certificate', ['data' => $data]);
                return $pdf->download('certificate.pdf');
                
                break;
                
            case 'nametag':
                $pdf = \PDF::loadView('pdf.nametag', ['data' => $data]);
                return $pdf->download('nametag-' . $data->full_name . '.pdf');
                
                break;
            
            default:
                return;
                break;
        }
        
    }

    public function render()
    {
        $participants = User::latest()->paginate(10);
        
        return view('livewire.participant', compact('participants'));
    }
}
