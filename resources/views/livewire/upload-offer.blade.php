<div>

    <form wire:submit.prevent="upload" enctype="multipart/form-data">

    <div class="form-group">
                   <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="offeruploadfile"  wire:model="myfilename">
                        <label class="custom-file-label" for="offeruploadfile">@if ($myfilename) {{ $myfilename->getClientOriginalName() }} @else Choose file @endif</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" wire:click="uploadfile" @if ($myfilename) style="background:green;color:#fff;cursor:pointer" @endif>Upload</span>
                      </div>

                    </div>
    </div>
    @if (session()->has('message'))
        <p class="text-green-500">{{ session('message') }}</p>
    @endif
</form>

<div class="row" style="margin-top:10px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Προσφορές</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" wire:model.live="mysearch" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Ημερ/νία</th>
                      <th>Αρχείο</th>
                      <th>&nbsp;</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse ($documents as $document)
                    <tr>
                      <td>{{ $document->created_at->format('d/m/Y') }}</td>
                      <td>{{ $document->name }}</td>
                      <td> <a href="{{ $document->getFirstMediaUrl() }}" target="_blank" class="text-blue-500 underline">Download</a></td>
                        <td><button wire:confirm="Να γίνει διαγραφή;" wire:click="deleteFile({{ $document->id }})" class="btn btn-danger btn-sm ml-2">Delete</button></td>
                    </tr>
                      @empty
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

</div>
