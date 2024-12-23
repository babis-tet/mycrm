<div>
    <h1>Phonebook</h1>

    <div class="letters">
        <!-- Display all letters -->
        @foreach($letters as $letter)
            <button
                wire:click="selectLetter('{{ $letter }}')"
                class="{{ $selectedLetter === $letter ? 'selected' : '' }}">
                {{ $letter }}
            </button>
        @endforeach
    </div>

    <div class="customers">
        <!-- Display customers -->
        @if($records->isEmpty() && $selectedLetter !== null)
            <p>No phone found for "{{ $selectedLetter }}"</p>
        @else
            <div class="phonebook-contacts">
                @foreach($records as $record)
                    <div class="phonebook-contact">
                        <div>
                            <div class="contactinfo">
                                <div><i class="fas fa-fw fa-user "></i></div>
                                <div>{{ $record->name }}</div>
                            </div>
                            <div class="contactinfo">
                                <div><i class="fas fa-fw fa-phone "></i></div>
                                <div>{{ $record->phone }}</div>
                            </div>
                            <div class="contactinfo">
                                <div><i class="fas fa-fw fa-mobile "></i></div>
                                <div>{{ $record->mobile }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
