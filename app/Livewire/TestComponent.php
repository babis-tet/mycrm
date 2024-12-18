<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class TestComponent extends Component
{
//    public function render()
//    {
//        return view('livewire.test-component');
//    }
 use WithFileUploads;

    public $file;

    public function upload()
    {
        $this->validate([
            'file' => 'required|file|max:2048', // Max file size of 2MB
        ]);

        // Create a new document and associate the uploaded file
        $document = Document::create(['name' => $this->file->getClientOriginalName()]);
        $document->addMedia($this->file)->toMediaCollection();

        // Reset the file input
        $this->file = null;

        session()->flash('message', 'File uploaded successfully.');
    }

    public function render()
    {
        return view('livewire.test-component', [
            'documents' => Document::with('media')->latest()->get(),
        ]);
    }
}
