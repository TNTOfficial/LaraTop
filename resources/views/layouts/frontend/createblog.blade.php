<x-app-layout>
    <section class="bg-white">
        <div class="container">
            <h3 class="py-3">Add New Blog</h3>
            @if(Session::has('success'))
            <div class=" alert alert-success">
                {{ Session::get('success')}}
            </div>
            @endif
            <form action="{{ route('site.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label class="fw-medium py-2" for="title">Title</label>
                <input type="text" name="title" id="title" class="w-100 border py-2 ps-2" placeholder="Title">

                <label class="fw-medium py-2" for="image">Image</label>
                <input type="file" name="image" id="image" class="w-100 border">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <label class="fw-medium py-2" for="content">Content</label>
                <textarea class="form-control " name="content" id="content" rows="3"></textarea>

                <button type="submit" class="btn btn-success my-3">Create Blog</button>
            </form>
        </div>
    </section>

    <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#content',
        });
    </script>

</x-app-layout>