<div>
    <div class="row">
        <div class="col-md-6 pb-3">
            <div class="input-group input-group-lg">
                <input wire:model.debounce.300ms="search" type="text" class="js-icon-search form-control" placeholder="Search links...">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <select wire:model="domain" class="form-control form-control-lg" id="re-listing-bedrooms" name="re-listing-bedrooms">
                <option value="">Select a domain..</option>
                @foreach(auth()->user()->domains as $domain)
                    <option value="{{ $domain->name }}">{{ $domain->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select wire:model="sortField" class="form-control form-control-lg" id="re-listing-bedrooms" name="re-listing-bedrooms">
                <option value="" selected>Sort by...</option>
                <option value="slug">Slug</option>
                <option value="enabled">Status</option>
                <option value="target">Target URL</option>
                <option value="redirects_count">Num. of Redirects</option>
                <option value="clicks_count">Num. of Clicks</option>
                <option value="created_at">Creation Date</option>
            </select>
        </div>
        <div class="col-md-2">
            <select wire:model="sortOrder" class="form-control form-control-lg" id="re-listing-bedrooms" name="re-listing-bedrooms">
                <option value="asc">Ascending</option>
                <option value="desc" selected>Descending</option>
            </select>
        </div>
    </div>

    @if($links->isNotEmpty())
        <div class="block border-bottom">
            @foreach($links as $link)
                <div class="block-content block-content-full border-bottom">
                    <div class="row align-items-center">
                        <div class="col-sm-6 py-10">
                            <h3 class="h4 text-muted font-w400 mb-0">
                                <button type="button" class="badge badge-light shortened-url" data-toggle="tooltip" data-placement="top" title="Click to Copy!" data-clipboard-text="{{ $link->url }}">
                                    {{ $link->url }}
                                </button>
                                <i class="fa fa-long-arrow-right mr-3 ml-3"></i> 
                                {{ $link->target }}
                            </h3>
                            <p class="font-size-sm text-muted mt-2 mb-0 ml-1">
                                <span class="font-w400">{{ $link->getRedirectsCount() }} redirects, {{ $link->getClicksCount() }} ad clicks.
                            </p>
                        </div>
                        <div class="col-sm-6 py-10 text-md-right">
                            <i class="fa fa-circle font-size-md @if($link->enabled) text-success @else text-danger @endif mr-5"></i>
                            <a class="btn btn-md btn-outline-secondary btn-rounded my-5" href="{{ url('/links', [$link->id]) }}">
                                <i class="fa fa-wrench mr-5"></i> Manage
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pull-right">
            {{ $links->links() }}
        </div>
    @else
        <h3 class="h5 text-muted mb-0 mt-50 text-center">No links found 😲</h3>
    @endif
</div>

@section('js_after')
    @livewireAssets
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <script>
        var clipboard = new ClipboardJS('.shortened-url');
    </script>
@endsection
