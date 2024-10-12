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
        <div class="comment d-flex align-items-center justify-content-between mb-3" id="comment-{{$comment->id}}">
            <div class="d-flex align-items-center">
                <img src="{{$comment->user->image}}" alt="user" class="circular-image me-2">
                <span>{{$comment->user->name}}: <span class="comment-text">{{$comment->comment}}</span></span>
            </div>
            @if($comment->user->id == Auth::id())
            <div class="ms-auto d-flex">
                <button class="edit-comment btn btn-sm me-2" data-comment-id="{{ $comment->id }}">
                    <i class="mdi mdi-table-edit"></i>
                </button>
                <button class="delete-comment btn btn-sm" data-comment-id="{{ $comment->id }}">
                    <i class="mdi mdi-delete"></i>
                </button>
            </div>
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

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // Toggle comments section visibility
    $('.toggle-comments').on('click', function() {
        const postId = $(this).data('post-id');
        const commentsSection = $('#comments-section-' + postId);
        commentsSection.toggle();
    });

    // Submit a comment
    $('.submit-comment').click(function() {
        const postId = $(this).data('post-id');
        const comment = $(`#comment-input-${postId}`).val();
        const userId = {{ auth()->id() }};  // Use the authenticated user's ID

        if (comment) {
            $.ajax({
                url: '/comments',  // Your route for storing comments
                method: 'POST',
                data: {
                    user_id: userId,
                    post_id: postId,
                    comment: comment,
                    _token: '{{ csrf_token() }}'  // CSRF token for security
                },
                success: function(response) {
                    // Append the new comment to the list
                    $(`#comments-list-${postId}`).append(
                        `<div class="comment" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 9px;" id="comment-${response.comment_id}">
                            <div style="flex-grow: 1;">
                                <img src="${response.image}" alt="user" class="circular-image me-2">
                                <span>${response.user_name}: <span class="comment-text">${response.comment}</span></span>
                            </div>
                            ${response.is_owner ? `
                            <div>
                                <button class="edit-comment btn btn-sm" data-comment-id="${response.comment_id}"><i class="mdi mdi-table-edit"></i></button>
                                <button class="delete-comment btn btn-sm" data-comment-id="${response.comment_id}"><i class="mdi mdi-delete"></i></button>
                            </div>` : ''}
                        </div>`
                    );
                    $(`#comment-input-${postId}`).val('');  // Clear the input
                },
                error: function(xhr) {
                    console.log(xhr.responseText);  // Log any errors
                }
            });
        } else {
            alert('Please write a comment before submitting.');
        }
    });

    // Edit comment functionality
    $(document).on('click', '.edit-comment', function () {
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
                    _token: '{{ csrf_token() }}'  // CSRF token for security
                },
                success: function(data) {
                    if (data.success) {
                        commentTextElement.text(newCommentText);
                    } else {
                        alert('Failed to update comment');
                    }
                }
            });
        }
    });

    // Delete comment functionality
    $(document).on('click', '.delete-comment', function () {
        const commentId = $(this).data('comment-id');

        if (confirm('Are you sure you want to delete this comment?')) {
            $.ajax({
                url: `/comments/${commentId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'  // CSRF token for security
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
