@foreach ($galeri as $item)
    <div class="col-12 col-md-4">
        <div class="card card-primary">
            <img class="card-img-top" src="{{ asset('galeri/' . $item->file) }}" alt="Card image cap">
            <div class="card-body text-center">
                <h4 class="card-title"> {{ Str::title($item->judul) }}</h4>
                @if(auth()->user()->level == 'admin')
                    <button data-id="{{ $item->id }}" id="hapus" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                @endif
            </div>
        </div>
    </div>
@endforeach
<div class="col-12">
    {!! $galeri->links() !!}
</div>
