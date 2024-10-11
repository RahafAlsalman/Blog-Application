@extends('layouts.admin.app')
@section('content')
   <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row mt-5" style="font-family: 'Tajawal', sans-serif; justify-content: center;">
            <div class="col-lg-8 grid-margin stretch-card ">
              <div class="card" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
              <div class="card-header">
              <div class="d-flex">
               <div class="p-2 flex-grow-1">  <h3>Edit Post</h3></div>
                 <div class="p-2"><button onclick="history.back()" class="btn back" title="Back">&larr; Back</button></div>
                   </div>
                     </div>      
                     <div class="card-body">
                     <form id="myForm" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                     @csrf  
                     @method('PUT')

        <div class="row d-flex justify-content-center">
            <div class="mb-4 col-8">
                <label for="title" class="d-flex justify-content-between">
                    <span class="text-start me-5">Title</span>
                    <span class="text-end ms-5">العنوان</span>
                </label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title}}" required>
                <span class="text-danger" id="titleError"></span>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="mb-4 col-8">
                <label for="content" class="d-flex justify-content-between">
                    <span class="text-start me-5">Content</span>
                    <span class="text-end ms-5">المحتوى</span>
                </label>
                <textarea class="form-control" id="content" name="content" required>{{ $post->content }}</textarea>
                <span class="text-danger" id="contentError"></span>
            </div>
        </div>
        
        <div class="row d-flex justify-content-end mr-2 mt-3">
        <button type="submit" class="btn btn-primary">Update Post</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Real-time validation for title
        $('#title').on('input', function() {
            const title = $(this).val().trim();
            const titleRegex = /^[a-zA-Z\s]*$/; // Only letters and spaces
            const titleError = $('#titleError');

            titleError.text(''); // Clear previous error

            if (title === '') {
                titleError.text('Title is required.');
            } else if (!titleRegex.test(title)) {
                titleError.text('Title must contain only letters.');
            }
        });

        // Real-time validation for content
        $('#content').on('input', function() {
            const content = $(this).val().trim();
            const wordCount = content.split(/\s+/).filter(Boolean).length; // Count words
            const contentError = $('#contentError');

            contentError.text(''); // Clear previous error

            if (wordCount < 2) {
                contentError.text('Content must contain at least 2 words.');
            }
        });
    });
</script>
@endsection
