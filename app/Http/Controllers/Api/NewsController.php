<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FastApiService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $fastApi;

    public function __construct(FastApiService $fastApi)
    {
        $this->fastApi = $fastApi;
    }

    public function index()
    {
        // Obtiene los posts de FastAPI (ajusta el endpoint según la API)
        $news = $this->fastApi->get('/news/news/posts');
        // Retorna la vista pasando la variable $news
        return view('Noticias', compact('news'));
    }

    // Los otros métodos pueden seguir existiendo para llamadas directas a la API (JSON)
    public function indexPosts()
    {
        $response = Http::get($this->fastApi->baseUri . '/posts');
        return response()->json($response->json());
    }

    // Guardar una nueva noticia (si es necesario)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $newPost = [
            'title' => $data['title'],
            'description' => $data['description'],
        ];

        try {
            $this->fastApi->post('/news/news/posts', $newPost);
            return redirect()->route('news.index')->with('success', 'Noticia guardada correctamente!');
        } catch (\Exception $e) {
            return back()->with('error', 'No fue posible guardar la noticia!');
        }
    }
    public function likePost(Request $request, $postId)
    {
        $userId = $request->input('user_id');
    
        try {
            // Utiliza el método postForm para enviar datos en formato form-urlencoded
            $response = $this->fastApi->postForm("/news/news/posts/{$postId}/like", [
                'user_id' => $userId
            ]);
    
            if ($response['message'] === 'Like registrado') {
                return response()->json([
                    'message' => 'Like registrado', 
                    'post_id' => $postId, 
                    'user_id' => $userId
                ]);
            } elseif ($response['message'] === 'Like removido') {
                return response()->json([
                    'message' => 'Like removido', 
                    'post_id' => $postId, 
                    'user_id' => $userId
                ]);
            } else {
                return response()->json(['message' => 'Error al registrar el like'], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al comunicarse con FastAPI', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function dislikePost(Request $request, $postId)
    {
        $userId = $request->input('user_id');

        try {
            $response = $this->fastApi->postForm("/news/news/posts/{$postId}/dislike", [
                'user_id' => $userId
            ]);

            if ($response['message'] === 'Dislike registrado') {
                return response()->json([
                    'message' => 'Dislike registrado',
                    'post_id' => $postId,
                    'user_id' => $userId
                ]);
            } elseif ($response['message'] === 'Dislike removido') {
                return response()->json([
                    'message' => 'Dislike removido',
                    'post_id' => $postId,
                    'user_id' => $userId
                ]);
            } else {
                return response()->json(['message' => 'Error al registrar el dislike'], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al comunicarse con FastAPI',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
