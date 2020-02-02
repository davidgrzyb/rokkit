<div>
    @isset($message)
        <div class="row mb-2">
            <div class="alert alert-success col-md-6 offset-md-3 text-center" role="alert">
                {{ $message }}
            </div>
        </div>
    @endisset

    <form class="push" action="be_ui_icons.php" method="post">
        <div class="input-group input-group-lg">
            <input wire:model.debounce.300ms="search" type="text" class="js-icon-search form-control" placeholder="Search domains...">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
    </form>

    @if($domains->isNotEmpty())
        <div class="block border-bottom">
            @foreach($domains as $domain)
                <div class="block-content block-content-full border-bottom">
                    <div class="row align-items-center">
                        <div class="col-sm-6 py-10">
                            <h3 class="h4 text-muted font-w400 mb-0">
                                <i class="fa fa-circle text-success mr-5"></i> 
                                {{ $domain->name }}
                            </h3>
                        </div>
                        <div class="col-sm-6 py-10 text-md-right">
                            <a class="btn btn-md btn-outline-secondary btn-rounded my-5" href="{{ url('/domain', [$domain->id]) }}">
                                <i class="fa fa-wrench mr-5"></i> Manage
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>

        <div class="pull-right">
            {{ $domains->links() }}
        </div>
    @else
        <h3 class="h5 text-muted mb-0 mt-50 text-center">No domains found 😲</h3>
    @endif
</div>

@section('js_after')
    @livewireAssets
    @livewireScripts
@endsection
