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
                                @if($domain->isEnabled())
                                    <i class="fa fa-circle text-success mr-5"></i> 
                                @else
                                    <i class="fa fa-circle text-warning mr-5" data-toggle="tooltip" data-placement="top" title="" data-original-title="Domain not properly configured."></i> 
                                @endif
                                {{ $domain->name }}
                            </h3>
                        </div>
                        <div class="col-sm-6 py-10 text-md-right">
                            <button class="remove-domain-btn btn btn-md btn-outline-danger btn-rounded my-5" id="{{ $domain->id }}" @if($domain->isDefault()) disabled @endif>
                                <i class="fa fa-remove mr-5"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pull-right">
            {{ $domains->links() }}
        </div>
    @else
        <h3 class="h5 text-muted mb-0 mt-50 text-center">No domains found 😲</h3>
    @endif
    <form method="POST" action="{{ url('/domains/delete') }}" id="delete-form" style="display:none;">
        @csrf
        <input type="hidden" id="id-to-delete" name="id">
    </form>
</div>

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('js_after')
    @parent
    @livewireAssets

    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}" aria-hidden="true"></script>
    <script aria-hidden="true">jQuery(function(){ Codebase.helpers('notify'); });</script>

    <script>
        $('.remove-domain-btn').click(function(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will remove the domain and permanently disable all associated links!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $('#id-to-delete').val(e.target.id);
                    $('#delete-form').submit();
                }
            })
        });
    </script>
@endsection
