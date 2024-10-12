// Utility function to show alerts
const showAlert = (title, text, icon) => Swal.fire({ title, text, icon });

// Toggle comments visibility
const toggleComments = postId => $(`#comments-section-${postId}`).toggle();

// Append a new comment to the comments list
const appendComment = (postId, { comment_id, image, user_name, comment, is_owner }) => {
    const actionButtons = is_owner ? `
        <div>
            <button class="edit-comment btn btn-sm" data-comment-id="${comment_id}"><i class="mdi mdi-table-edit"></i></button>
            <button class="delete-comment btn btn-sm" data-comment-id="${comment_id}"><i class="mdi mdi-delete"></i></button>
        </div>` : '';

    const commentHtml = `
        <div class="comment" id="comment-${comment_id}" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 9px;">
            <div style="flex-grow: 1;">
                <img src="${image}" alt="user" class="circular-image me-2">
                <span>${user_name}: <span class="comment-text">${comment}</span></span>
            </div>${actionButtons}
        </div>`;
    
    $(`#comments-list-${postId}`).append(commentHtml);
};

// AJAX error handling
const handleAjaxError = xhr => console.error(xhr.responseText);

// Confirm deletion of a post
const confirmDelete = postId => {
    showAlert('Are you sure?', 'You won\'t be able to revert this!', 'warning').then(result => {
        if (result.isConfirmed) $(`#deleteForm${postId}`).submit();
    });
};

// Event listeners
$(document).on('click', '.delete-post', function() {
    confirmDelete($(this).data('post-id'));
});

$('.toggle-comments').on('click', function() {
    toggleComments($(this).data('post-id'));
});

$('.submit-comment').on('click', function() {
    const postId = $(this).data('post-id');
    const comment = $(`#comment-input-${postId}`).val();

    if (!comment) return alert('Please write a comment before submitting.');

    $.ajax({
        url: '/comments',
        method: 'POST',
        data: { user_id: userId, post_id: postId, comment, _token: csrfToken },
        success: response => {
            appendComment(postId, response);
            $(`#comment-input-${postId}`).val(''); // Clear input
        },
        error: handleAjaxError
    });
});

$(document).on('click', '.edit-comment', function() {
    const commentId = $(this).data('comment-id');
    const commentTextElement = $(`#comment-${commentId} .comment-text`);
    const newCommentText = prompt('Edit your comment:', commentTextElement.text());

    if (newCommentText !== null) {
        $.ajax({
            url: `/comments/${commentId}`,
            type: 'PUT',
            data: { comment: newCommentText, _token: csrfToken },
            success: data => {
                if (data.success) commentTextElement.text(newCommentText);
                else alert('Failed to update comment');
            }
        });
    }
});

$(document).on('click', '.delete-comment', function() {
    const commentId = $(this).data('comment-id');
    if (confirm('Are you sure you want to delete this comment?')) {
        $.ajax({
            url: `/comments/${commentId}`,
            type: 'DELETE',
            data: { _token: csrfToken },
            success: data => {
                if (data.success) $(`#comment-${commentId}`).remove();
                else alert('Failed to delete comment');
            }
        });
    }
});