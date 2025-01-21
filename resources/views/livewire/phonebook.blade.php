<div>

    <!-- Alphabet Switcher -->
    <div class="alphabet-switcher">
        <button wire:click="setGreekAlphabet"
                class="{{ $currentAlphabet === 'greek' ? 'selected' : '' }}">
            Α-Ω
        </button>
        <button wire:click="setLatinAlphabet"
                class="{{ $currentAlphabet === 'latin' ? 'selected' : '' }}">
            A-Z
        </button>
    </div>

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
                    <div class="col-md-3">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header" style="background: #d9e0e8">
                <h5 class="widget-user-desc"><i class="fas fa-fw fa-user "></i></h5>
                  <h3 class="widget-user-username">{{ $record['name'].' '.$record['surname'] ?? '' }}</h3>
              </div>
              <div class="widget-user-image">

              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header"><i class="fas fa-fw fa-phone "></i></h5>
                      <span class="description-text">{{ $record['phone'] ?? '' }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><i class="fas fa-fw fa-mobile "></i></h5>
                      <span class="description-text">{{ $record['mobile'] ?? '' }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header"><i class="fas fa-fw fa-envelope "></i></h5>
                      <span class="description-text">{{ $record['email'] ?? '' }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
