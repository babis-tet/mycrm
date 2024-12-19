{{--<div>--}}
{{--    <form wire:submit.prevent="upload">--}}
{{--        <input type="file" wire:model.defer="myfilename" name="myfilename">--}}
{{--        @if ($myfilename)--}}
{{--            <p>Selected file: {{ $myfilename->getClientOriginalName() }}</p>--}}
{{--        @endif--}}
{{--        @error('myfilename') <span class="text-red-500">{{ $message }}</span> @enderror--}}

{{--        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2">Upload</button>--}}
{{--    </form>--}}

{{--    @if (session()->has('message'))--}}
{{--        <p class="text-green-500">{{ session('message') }}</p>--}}
{{--    @endif--}}
{{--</div>--}}

<div>
<form wire:submit.prevent="upload" enctype="multipart/form-data">
        <input type="file" wire:model="myfilename">
        <button type="button" wire:click="mydata">
            Upload Offer
        </button>
    @if (session()->has('message'))
        <p class="text-green-500">{{ session('message') }}</p>
    @endif
</form>

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
