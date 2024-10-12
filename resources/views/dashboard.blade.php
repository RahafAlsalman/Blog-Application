@extends('layouts.admin.app')
@section('content')

<div class="container-fluid page-body-wrapper">
    
        <div class="content-wrapper">
        @can('create post')

        <div class="d-flex flex-row-reverse">
                   <div class="p-2">                                   
                        <a href="{{ url('createPost') }}" type="button" class="btn btn-primary btn-sm">Add Post</a>
                   </div>
                   <div class="p-2">                                   
                        <a href="{{ url('createPost') }}" type="button" class="btn btn-primary btn-sm">My Post</a>
                   </div>
                   <div class="p-2">                                   
                        <a href="{{ url('createPost') }}" type="button" class="btn btn-primary btn-sm">all Post</a>
                   </div>
                </div>  
                @endcan

            <div class="row mb-4" style="font-family: 'Tajawal', sans-serif;">   
            <div class="col-lg-12 grid-margin stretch-card">
    @foreach($posts as $post)
        <div class="card">
            <div class="card-body">
                <div class="card mb-3">
                    <div class="card-header d-flex align-items-center">
                        <img src="{{$post->user->image}}" alt="User Image" class="circular-image me-3 mr-3">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold">{{$post->user->name}}</span>
                                    <span class="text-muted ms-2">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="p-2">
                                    <form id="deleteForm{{ $post->id }}" class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @can('update post')

                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
                                        <i class="mdi mdi-table-edit"></i>
                                        </a>
                                        @endcan
                                        @can('delete post')

                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $post->id }}')" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                        @endcan

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{$post->content}}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-start ">
                        <a class="btn btn-sm btn-facebook toggle-comments" data-post-id="{{$post->id}}" style="cursor: pointer;">
                            <i class="mdi mdi-comment-outline"></i>
                        </a>
                    </div>
                </div>
<!-- Comments Section -->
<div class="mt-3 ml-3 commentsSection" id="comments-section-{{$post->id}}" style="display: none;">
    <h6>Comments:</h6>
    <div class="comments-list" id="comments-list-{{$post->id}}">
        @foreach($post->comments as $comment)
            <div class="comment" id="comment-{{$comment->id}}">
                <img src="{{$comment->user->image}}" alt="user" class="circular-image">
                <span>{{$comment->user->name}}: <span class="comment-text">{{$comment->comment}}</span></span>
                @if($comment->user->id == Auth::id()) <!-- Check if the comment belongs to the logged-in user -->
                    <button class="edit-comment btn btn-sm btn-secondary" data-comment-id="{{$comment->id}}">Edit</button>
                    <button class="delete-comment btn btn-sm btn-danger" data-comment-id="{{$comment->id}}">Delete</button>
                @endif
            </div>
        @endforeach
    </div>
    <div class="input-group mt-3">
        <input type="text" id="comment-input-{{$post->id}}" class="form-control" placeholder="Write a comment...">
        <div class="input-group-append">
            <button class="submit-comment btn btn-sm btn-facebook" data-post-id="{{$post->id}}" type="button">
                <i class="mdi mdi-send"></i>
            </button>
        </div>
    </div>

                </div>
            </div>
            @endforeach
        </div>
  
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function confirmDelete(postId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#deleteForm' + postId).submit();
        }
    });
}

$(document).ready(function() {
    // Use a class selector to target all toggle buttons
    $('.toggle-comments').on('click', function() {
        const postId = $(this).data('post-id');
        const commentsSection = $('#comments-section-' + postId);
        
        // Toggle the visibility of the comments section
        commentsSection.toggle();

    });
    $('.submit-comment').click(function() {
     
    const postId = $(this).data('post-id');
    const comment = $(`#comment-input-${postId}`).val(); // Use backticks for template literals
    const userId = {{ auth()->id() }}; // Assuming the user is authenticated

    if (comment) {
        $.ajax({
            url: '/comments', // Change this to your route for storing comments
            method: 'POST',
            data: {
                user_id: userId,
                post_id: postId,
                comment: comment,
                _token: '{{ csrf_token() }}' // Include CSRF token for security
            },
            success: function(response) {
    // Add the new comment to the correct comments list
    $(`#comments-list-${postId}`).append( // Use backticks for template literals
        `<div class="comment">
            <img src="${response.image}" alt="user" class="circular-image">
            <span>${response.user_name}: ${response.comment}</span>
            ${response.is_owner ? `
                <button class="edit-comment btn btn-sm btn-secondary" data-comment-id="${response.comment_id}">Edit</button>
                <button class="delete-comment btn btn-sm btn-danger" data-comment-id="${response.comment_id}">Delete</button>
            ` : ''}
        </div>`
    );
    $(`#comment-input-${postId}`).val(''); // Clear the input
},
            error: function(xhr) {
                console.log(xhr.responseText); // Handle errors if needed
            }
        });
    } else {
        alert('Please write a comment before submitting.');
    }
});

$('.edit-comment').click(function () {
        const commentId = $(this).data('comment-id');
        const commentTextElement = $(`#comment-${commentId} .comment-text`);
        const currentText = commentTextElement.text();
        
        const newCommentText = prompt('Edit your comment:', currentText);
        
        if (newCommentText !== null) {
            $.ajax({
                url: `/comments/${commentId}`,
                type: 'PUT',
                data: {
                    comment: newCommentText,
                    _token: '{{ csrf_token() }}' // Add CSRF token for Laravel
                },
                success: function (data) {
                    if (data.success) {
                        commentTextElement.text(newCommentText);
                    } else {
                        alert('Failed to update comment');
                    }
                }
            });
        }
    });

    // Delete Comment
    $('.delete-comment').click(function () {
        const commentId = $(this).data('comment-id');

        if (confirm('Are you sure you want to delete this comment?')) {
            $.ajax({
                url: `/comments/${commentId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // Add CSRF token for Laravel
                },
                success: function (data) {
                    if (data.success) {
                        $(`#comment-${commentId}`).remove();
                    } else {
                        alert('Failed to delete comment');
                    }
                }
            });
        }
    });
});
</script>





@endsection
