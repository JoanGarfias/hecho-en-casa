use App\Http\Controllers\ControladorCatalogo;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return response()->json(['message' => 'API funcionando']);
});

Route::get('categorias', [ControladorCatalogo::class, 'obtenerCategorias']);