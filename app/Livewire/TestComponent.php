<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class TestComponent extends Component
{
    use WithFileUploads;

    public $myfilename;

    public $id;

    public function mydata()
    {
//        $this->validate([
//            'myfilename' => 'required|file|max:2048',
//        ]);
//
//        $filePath = $this->myfilename->store('uploads', 'public');
//
//        session()->flash('message', 'File uploaded successfully to:');

        $this->validate([
            'myfilename' => 'required|file|max:2048', // Max file size of 2MB
        ]);

        // Create a new document and associate the uploaded file
        $document = Document::create(['name' => $this->myfilename->getClientOriginalName(), 'documentable_type' => Customer::class, 'documentable_id' => $this->id]);
        $document->addMedia($this->myfilename)->toMediaCollection();

        // Reset the file input
        $this->myfilename = null;

        session()->flash('message', 'File uploaded successfully.');
    }


    public function render()
    {
        return view('livewire.test-component', [
            'documents' => Document::with('media')->latest()->get(),
        ]);
    }
}
