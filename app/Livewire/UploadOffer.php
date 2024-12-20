<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
class UploadOffer extends Component
{
    use WithFileUploads;
    public $myfilename;
    public $id;
    public $documents;

    protected $listeners = ['tabShown' => 'clear'];
    public function mount($id)
    {
        $this->id = $id;
        $this->loadDocuments();
    }


    public function clear() {
        $this->documents = [];
    }

    public function loadDocuments()
    {
        // Fetch documents for the specified customer ID
        $this->documents = Document::where('documentable_type', Customer::class)
            ->where('documentable_id', $this->id)
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
        $document = Document::create(['name' => $this->myfilename->getClientOriginalName(), 'documentable_type' => Customer::class, 'documentable_id' => $this->id]);
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
            ->log('Offer Delete file '.$document->name);

        } else {
            session()->flash('error', 'File not found.');
        }
    }

    public function render()
    {
        return view('livewire.upload-offer');
    }
}
