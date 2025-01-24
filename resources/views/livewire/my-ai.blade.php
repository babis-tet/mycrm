<div class="row" style="margin-top:20px;">
    <div class="col-md-12">
        <div class="card card-secondary direct-chat direct-chat-primary">
    <!-- Card Header -->
    <div class="card-header">
        <h3 class="card-title">Chat with My AI</h3>
        <div class="card-tools">
            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">
                {{ count($chatHistory) }}
            </span>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <!-- Chat Body -->
    <div class="card-body">
        <!-- Chat Messages -->
        <div class="direct-chat-messages" id="chat-container" style="height: 600px;">
            @foreach ($chatHistory as $chat)
                @if ($chat['role'] === 'user')
                    <!-- User Message -->
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-right">
                                {{ auth()->check() ? auth()->user()->name : 'You' }}
                            </span>
                            <span class="direct-chat-timestamp float-left">{{ now()->format('h:i A') }}</span>
                        </div>
                        <i class="fas fa-user-circle direct-chat-img text-primary text-xl"></i>
                        <div class="direct-chat-text bg-info">
                            {{ $chat['content'] }}
                        </div>
                    </div>
                @else
                    <!-- AI Response -->
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">AI Assistant</span>
                            <span class="direct-chat-timestamp float-right">{{ now()->format('h:i A') }}</span>
                        </div>
                        <i class="fas fa-robot direct-chat-img text-warning text-xl"></i>
                        <div class="direct-chat-text bg-light">
                            {{ $chat['content'] }}
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Loading Spinner -->
            @if ($isLoading)
                <div class="text-center my-3">
                    <i class="fas fa-spinner fa-spin text-primary"></i>
                </div>
            @endif
        </div>
    </div>

    <!-- Chat Footer -->
    <div class="card-footer">
        <form wire:submit.prevent="askOpenAi">
            <div class="input-group">
                <textarea
                    wire:model.defer="question"
                    class="form-control"
                    rows="1"
                    placeholder="Type your message..."
                ></textarea>
                <span class="input-group-append">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        {{ $isLoading ? 'disabled' : '' }}
                    >
                        Send
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
    </div>
</div>
