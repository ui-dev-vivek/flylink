<div>
    <form wire:submit.prevent="shortLink" method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
        <div class="input-group input-group-lg">
            <span class="input-group-text bi-link-45deg" style="font-size: 2rem" id="basic-addon1"></span>
            <input wire:model="url" type="search" class="form-control" id="keyword"
                placeholder="Link to short quickly → flyl.ink/avRAsg" aria-label="Search">
            <button type="submit" class="form-control">Short</button>
        </div>
        @if ($errorMessage)
            <p class="text-white ps-5">{{ $errorMessage }}</p>
        @endif
    </form>

    @if ($shortenedUrl)
        <div class="shadow p-2 mt-3 rounded">
            <p class="text-white"><a href="{{ $url }}" target="_blank">{{ $shortenedUrl }}</a>
            </p>
        </div>
    @elseif ($errorMessage)
        <div class="shadow p-2 mt-3 rounded">

        </div>
    @endif
</div>
