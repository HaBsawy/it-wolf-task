@if (session()->has('success'))
    <div class="alert alert-success icons-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icofont icofont-close-line-circled"></i>
        </button>
        <p>{{ session()->get('success') }}</p>
    </div>
@endif
@if (session()->has('danger'))
<div class="alert alert-danger icons-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="icofont icofont-close-line-circled"></i>
    </button>
    <p>{{ session()->get('danger') }}</p>
</div>
@endif
@if ($errors->all())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger icons-alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled"></i>
            </button>
            <p>{{ $error }}</p>
        </div>
    @endforeach
@endif
