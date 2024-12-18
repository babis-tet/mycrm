<div>
    <form wire:submit.prevent="upload" class="mb-4">
        <input type="file" wire:model="file">
        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2">Upload</button>
    </form>

    @if (session()->has('message'))
        <div class="text-green-500 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="font-bold mb-2">Uploaded Files:</h2>
    <ul>
        @forelse ($documents as $document)
            <li>
                {{ $document->name }}
                <a href="{{ $document->getFirstMediaUrl() }}" target="_blank" class="text-blue-500 underline">Download</a>
            </li>
        @empty
            <li>No files uploaded yet.</li>
        @endforelse
    </ul>
</div>
