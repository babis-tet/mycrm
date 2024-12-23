<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\Supplier;
use Livewire\Component;

class Phonebook extends Component
{
    public $records = [];
    public $selectedLetter = null;
    public $letters = [];

    public function mount()
    {
        // Generate letters A-Z
        $this->letters = range('A', 'Z');
        // Initially load all customers or none
        $this->records = collect();
    }

    public function selectLetter($letter)
    {
        $this->selectedLetter = $letter;

        // Query customers whose names start with the selected letter
        $customers = Customer::where('name', 'LIKE', "$letter%")->orderBy('name')->get();

        // Query suppliers
        $suppliers = Supplier::where('name', 'LIKE', "$letter%")->orderBy('name')->get();

        // Query contacts
        $contacts = Contact::where('name', 'LIKE', "$letter%")->orderBy('name')->get();

        // Merge both collections
        $this->records = $customers->merge($suppliers)->merge($contacts)->sortBy('name');
    }

    public function render()
    {
        return view('livewire.phonebook');
    }
}
