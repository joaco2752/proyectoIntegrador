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
}
