Illuminate\Support\Facades\Cache::forever("spoonacular:import:offset", 123);
echo json_encode(["cache_get" => Illuminate\Support\Facades\Cache::get("spoonacular:import:offset")]);
