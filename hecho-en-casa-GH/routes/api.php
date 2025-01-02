use App\Http\Controllers\ControladorCatalogo;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return response()->json(['message' => 'API funcionando']);
});

Route::get('fijo/categorias', [ControladorCatalogo::class, 'obtenerCategorias']);