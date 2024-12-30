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

    public $currentAlphabet = 'greek'; // Default to Latin alphabet

    public function mount()
    {
        // Generate letters A-Z
        $this->setGreekAlphabet();
        // Initially load all customers or none
        $this->records = collect();
    }

    public function setLatinAlphabet()
    {
        $this->currentAlphabet = 'latin';
        $this->letters = range('A', 'Z'); // Set letters to A-Z
    }

    public function setGreekAlphabet()
    {
        $this->currentAlphabet = 'greek';
        $this->letters = [
        'Α', 'Β', 'Γ', 'Δ', 'Ε', 'Ζ', 'Η', 'Θ',
        'Ι', 'Κ', 'Λ', 'Μ', 'Ν', 'Ξ', 'Ο', 'Π',
        'Ρ', 'Σ', 'Τ', 'Υ', 'Φ', 'Χ', 'Ψ', 'Ω'
        ];
    }

    public function selectLetter($letter)
    {
        $this->selectedLetter = $letter;

        $customers = Customer::where('name', 'LIKE', "$letter%")->orderBy('name')->get()->toArray();
        $suppliers = Supplier::where('name', 'LIKE', "$letter%")->orderBy('name')->get()->toArray();
        $contacts = Contact::where('name', 'LIKE', "$letter%")->orderBy('name')->get()->toArray();

        // Merge and sort the arrays
        $this->records = collect(array_merge($customers, $suppliers, $contacts))->sortBy('name');

    }

    public function render()
    {
        return view('livewire.phonebook');
    }
}
