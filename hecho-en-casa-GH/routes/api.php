use App\Http\Controllers\ControladorCatalogo;

Route::get('categorias/{categoria?}', [ControladorCatalogo::class, 'mostrar']);