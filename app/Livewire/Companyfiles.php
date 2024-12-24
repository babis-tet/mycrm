<?php

namespace App\Livewire;

use App\Models\Document;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class Companyfiles extends Component
{
    use WithFileUploads;
    public $myfilename;
    public $id;
    public $documents;

    public $mysearch = '';

    public function mount()
    {
        $this->loadDocuments();
    }


    public function clear() {
        $this->documents = [];
    }

    public function loadDocuments()
    {
        // Fetch documents for the specified customer ID
        $this->documents = Document::where('documentable_type', Company::class)
            ->where('name', 'like', '%' . $this->mysearch . '%')
            ->with('media')
            ->latest()
            ->get();
    }

    public function uploadfile()
    {
        $this->validate([
            'myfilename' => 'required|file|max:5048', // Max file size of 2MB
        ]);

        // Create a new document and associate the uploaded file
        $document = Document::create(['name' => $this->myfilename->getClientOriginalName(), 'documentable_type' => Company::class, 'documentable_id' => 1]);
        $document->addMedia($this->myfilename)->toMediaCollection();

        activity()
            ->causedBy(auth()->user()) // Log which user performed the action
            ->withProperties(['file_name' => $this->myfilename->getClientOriginalName()])
            ->log('Offer Upload');

        // Reset the file input
        $this->myfilename = null;

        $this->loadDocuments();

        session()->flash('message', 'File uploaded successfully.');
    }

    public function deleteFile($documentId)
    {
        $document = Document::find($documentId);

        if ($document) {
            $document->clearMediaCollection();
            $document->delete();
            session()->flash('message', 'File deleted successfully.');

            $this->loadDocuments();

            activity()
            ->causedBy(auth()->user()) // Log which user performed the action
            ->withProperties(['file_name' => $document->name])
            ->log('Company File Deleted '.$document->name);

        } else {
            session()->flash('error', 'File not found.');
        }
    }

    public function render()
    {
        $this->loadDocuments();
        return view('livewire.companyfiles');
    }
}
