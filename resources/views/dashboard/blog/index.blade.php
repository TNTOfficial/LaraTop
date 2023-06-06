@extends('layouts.admin.master')


@section('style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection

@section('breadcrumb-title')
<h3>Blogs</h3>
@endsection

@section('content')
<div class="container-fluid">
    <div class="email-wrap">
        <div class="row">
            <div class="box-col-12">
                <div class="email-right-aside">
                    <div class="card email-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pe-0 b-r-light"></div>
                                <div class="email-top">
                                </div>
                                <table class="w-100">
                                    <thead>
                                        <tr class="border-bottom-primary text-center">
                                            <th class="py-3">Sr.No.</th>
                                            <th class="py-3">Title</th>
                                            <th class="py-3">Image</th>
                                            <th class="py-3">Content</th>
                                            <th class="py-3">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($blogs as $blog)
                                        <tr class="border-bottom-secondary text-center">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="py-3">{{$blog->title }}</td>
                                            <td> <img class="img-60 me-2" style="width:60px;height:60px" src="{{ asset('/storage/' . $blog->img) }}" alt="profile"></td>
                                            <td>
                                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ $blog->content }}">
                                                    {{ $blog->shortMsg }}
                                                </span>
                                            </td>
                                            <td class="py-3">
                                                <ul class="action d-flex align-items-center justify-content-center list-unstyled">
                                                    <a href="{{route('blogs.show', $blog->id)}}"><i class="fa-solid fa-pen-to-square fs-4 text-danger pe-2"></i></a>
                                                    <form action="{{ route('blogs.destroy', $blog->id) }}" onsubmit="confirmDelete(event);" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <li class="delete">
                                                            <button type="submit" class="border-0 bg-transparent">
                                                                <i class="fa-solid fa-trash-can fs-5 text-primary"></i></span>
                                                        </li>
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
    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>
<script src="{{asset('assets/js/email-app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection