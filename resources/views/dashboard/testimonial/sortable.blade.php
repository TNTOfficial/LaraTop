@extends('layouts.admin.master')
@section('breadcrumb-title')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-header row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <h3 class="m-0 text-center text-lg-start">Testimonial Sorting</h3>
                    </div>
                    <div class="col-lg-6 col-md-12 text-center text-lg-end">
                        <a href="{{ route('testimonials.index') }}" class="btn btn-primary" type="button">Back</a>
                    </div>
                </div>
                <div id="simpleList" class="list-group">
                    @foreach($items as $item)
                    <div class="list-group-item" data-id="{{ $item->id }}"><img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}" class="img-fluid" width="150" height="auto">
                        {{ $item->name }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>

</script>
@livewireScripts
<script>
    Sortable.create(simpleList, {
        onEnd: function(evt) {


            // Send an AJAX request to the server-side endpoint to update the position of each item in the database
            var order = [];
            $("#simpleList .list-group-item").each(function() {
                order.push($(this).attr("data-id"));
            });
            $.ajax({
                url: "{{ route('testimonials.updateOrder') }}",
                type: "POST",
                data: {
                    order: order
                },
                headers: {
                    "X-CSRF-Token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
            });
        },
    });
</script>
@endsection