{{--<div>--}}
{{--    <form wire:submit.prevent="upload" class="mb-4">--}}
{{--        <input type="file" wire:model="file">--}}
{{--        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror--}}

{{--        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2">Upload</button>--}}
{{--    </form>--}}

{{--    @if (session()->has('message'))--}}
{{--        <div class="text-green-500 mb-4">--}}
{{--            {{ session('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <h2 class="font-bold mb-2">Uploaded Files:</h2>--}}
{{--    <ul>--}}
{{--        @forelse ($documents as $document)--}}
{{--            <li>--}}
{{--                {{ $document->name }}--}}
{{--                <a href="{{ $document->getFirstMediaUrl() }}" target="_blank" class="text-blue-500 underline">Download</a>--}}
{{--            </li>--}}
{{--        @empty--}}
{{--            <li>No files uploaded yet.</li>--}}
{{--        @endforelse--}}
{{--    </ul>--}}
{{--</div>--}}

<div>



<div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Large Modal Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Row 1 -->
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Enter your name">
                    </div>
                    <!-- Row 2 -->
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#largeModal">Open Large Modal</button>
</div>
