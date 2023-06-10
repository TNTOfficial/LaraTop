@extends('layouts.admin.master')
@section('title', 'CLS Slider')
@section('css')
@endsection
@section('style')
@livewireStyles
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
                <div class="card-header row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <h3 class="m-0 text-center text-lg-start">Gallery</h3>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="text-center text-lg-end">
                            <a href="{{route('gallery.create')}}" class="btn btn-success" type="button"><i class="fa-solid fa-plus"></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-center">
                    <table class="table">
                        <thead>
                            <tr class="border-bottom-primary">
                                <th>S.No.</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $item)
                            <tr class="border-bottom-secondary">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td> <img src="{{ asset('/storage/gallery/' . $item->img) }}" alt="profile" class="rounded" style="height:120px; width:120px;object-fit:cover;"></td>
                                <td>
                                    <ul class="action d-flex align-items-center list-unstyled m-0 justify-content-center">
                                        <li class="edit"> <a href="{{route('gallery.edit', $item->id)}}">
                                                <i class="fa-solid fa-pen-to-square fs-5 text-danger"></i></a></li>
                                        <form action="{{route('gallery.destroy', $item->id)}}" onsubmit="confirmDelete(event);" method="POST">
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
</script>

<script src="https://kit.fontawesome.com/9afdb21cde.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection