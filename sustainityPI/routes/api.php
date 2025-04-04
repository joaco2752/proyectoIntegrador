<?php
// filepath: c:\laragon\www\proyectoIntegrador\sustainityPI\routes\api.php
use App\Http\Controllers\Api\NewsController;

Route::prefix('news/news')->group(function () {
    // Endpoints para Posts
    Route::get('/posts', [NewsController::class, 'indexPosts']);
    Route::get('/posts/{id}', [NewsController::class, 'showPost']);
    Route::post('/posts', [NewsController::class, 'createPost']);
    Route::put('/posts/{id}', [NewsController::class, 'updatePost']);
    Route::delete('/posts/{id}', [NewsController::class, 'deletePost']);

    // Endpoints para Comments
    Route::post('/posts/{post_id}/comments', [NewsController::class, 'createComment']);
    Route::get('/posts/{post_id}/comments', [NewsController::class, 'getComments']);
    Route::put('/comments/{comment_id}', [NewsController::class, 'updateComment']);
    Route::delete('/comments/{comment_id}', [NewsController::class, 'deleteComment']);

    // Endpoints para Likes/Dislikes
    Route::post('/posts/{post_id}/like', [NewsController::class, 'likePost']);
    Route::post('/posts/{post_id}/dislike', [NewsController::class, 'dislikePost']);
    Route::post('/comments/{comment_id}/like', [NewsController::class, 'likeComment']);
    Route::post('/comments/{comment_id}/dislike', [NewsController::class, 'dislikeComment']);
});