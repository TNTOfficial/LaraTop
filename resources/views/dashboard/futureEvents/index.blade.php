@extends('layouts.admin.master')
@section('title', 'CLS Slider')
@section('css')
@endsection
@section('style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<style>
    .border-bottom-primary th {
        padding: 21px 5px;
        font-weight: bold;
        font-size: 20px;
    }
</style>
@endsection

@section('breadcrumb-title')
@endsection

@section('content')
<div class="container-fluid basic_table">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-header row">
                    <div class="col-lg-6 col-md-12">
                        <h3 class="m-0 text-center text-lg-start">Future</h3>
                    </div>
                    <div class="col-lg-6 col-md-12">
                       <div class="text-center text-lg-end">
                       <a href="{{ route('futureEvents.create') }}" class="btn btn-success" type="button"><i class="fa-solid fa-plus"></i> Add</a>
                       </div>
                    </div>
                </div>
                <div class="table-responsive text-center">
                    <table class="table">
                        <thead>
                            <tr class="border-bottom-primary">
                                <th scope="col">S.No.</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Sub title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Order</th>
                                <th scope="col">Event Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($items as $item)
                            <tr class="border-bottom-secondary">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td> <img class="img-60 me-2" src="{{ asset('/storage/' . $item->img) }}" alt="profile"></td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->sub_title }}</td>
                                <td>
                                    <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ $item->description }}">
                                        {{ $item->shortDesc }}
                                    </span>
                                </td>
                                <td><span @class([ 'badge' , 'badge-danger'=> !$item->status,
                                        'badge-success' => $item->status,
                                        ])>{{ $item->status ? 'Active' : 'Inactive' }}
                                </td>
                                <td>{{ $item->order }}</td>
                                <td>{{ $item->eventDay }}</td>
                                <td>
                                    <ul class="action d-flex align-items-center list-unstyled justify-content-center m-0">
                                        <li class="edit"> <a href="{{ route('futureEvents.edit', $item->id) }}">
                                                <i class="fa-solid fa-pen-to-square fs-5 text-danger"></i></a></li>

                                        <form action="{{ route('futureEvents.destroy', $item->id) }}" onsubmit="confirmDelete(event);" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <li class="delete"><button type="submit" class="border-0 bg-transparent">
                                                    <i class="fa-solid fa-trash-can fs-5 text-primary"></i>
                                                    </span></li>
                                        </form>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function confirmDelete(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        })
    }
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>

<script src="https://kit.fontawesome.com/9afdb21cde.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection