<?php
// filepath: c:\laragon\www\proyectoIntegrador\sustainityPI\routes\api.php
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NewsController;

Route::prefix('usuarios')->group(function () {
    // Endpoints para usuarios
    Route::get('/', [UserController::class, 'leerUsuarios']);
    Route::get('/{id}', [UserController::class, 'leerUsuario']);
    Route::post('/', [UserController::class, 'agregarUsuario']);
    Route::put('/{id}', [UserController::class, 'actualizarUsuario']);
    Route::delete('/{id}', [UserController::class, 'eliminarUsuario']);
});

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
    Route::delete('/posts/{post_id}/like', [NewsController::class, 'removeLikePost']);
    Route::post('/posts/{post_id}/dislike', [NewsController::class, 'dislikePost']);
    Route::delete('/posts/{post_id}/dislike', [NewsController::class, 'removeDislikePost']);

    // Endpoints para Comments Likes/Dislikes
    Route::post('/comments/{comment_id}/like', [NewsController::class, 'likeComment']);
    Route::delete('/comments/{comment_id}/like', [NewsController::class, 'removeLikeComment']);
    Route::post('/comments/{comment_id}/dislike', [NewsController::class, 'dislikeComment']);
    Route::delete('/comments/{comment_id}/dislike', [NewsController::class, 'removeDislikeComment']);

    // Endpoints para obtener Likes/Dislikes
    Route::get('/posts/{post_id}/likes', [NewsController::class, 'getPostLikes']);
    Route::get('/posts/{post_id}/dislikes', [NewsController::class, 'getPostDislikes']);
});

Route::post('/news/news/posts/{post_id}/like', [NewsController::class, 'likePost']);
Route::post('/news/news/posts/{post_id}/dislike', [NewsController::class, 'dislikePost']);
