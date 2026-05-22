<?php
$recipes = App\Models\Recipe::query()->where(function($q){
    $q->whereNull("summary")->orWhere("summary","")
      ->orWhereNull("instructions")->orWhere("instructions","")
      ->orWhereNull("calories")->orWhereNull("protein")->orWhereNull("fat");
})->get();

$updated = 0;
foreach($recipes as $recipe){
    $resp = Illuminate\Support\Facades\Http::acceptJson()->timeout(30)->get("https://api.spoonacular.com/recipes/{$recipe->spoonacular_id}/information", [
        "apiKey" => (string)config("services.spoonacular.key"),
        "includeNutrition" => true
    ]);
    if(!$resp->successful()){
        continue;
    }
    $data = $resp->json();
    $summary = trim(strip_tags((string)($data["summary"]??"")));
    $instructions = trim((string)($data["instructions"]??""));
    if($instructions === ""){
        $steps = [];
        foreach((array)($data["analyzedInstructions"]??[]) as $section){
            foreach((array)($section["steps"]??[]) as $step){
                $txt = trim((string)($step["step"]??""));
                if($txt !== ""){$steps[] = $txt;}
            }
        }
        $instructions = $steps ? implode(PHP_EOL, $steps) : "";
    }
    $calories = $recipe->calories;
    if($calories === null && preg_match('/([0-9]+(?:\.[0-9]+)?)\s*calories\b/i', $summary, $m) && is_numeric($m[1])){
        $calories = (int)round((float)$m[1]);
    }
    $protein = $recipe->protein;
    $proteinUnit = $recipe->protein_unit;
    if($protein === null && preg_match('/([0-9]+(?:\.[0-9]+)?)\s*(g|mg|mcg|µg)?\s*(?:of\s+)?protein\b/i', $summary, $m) && is_numeric($m[1])){
        $protein = round((float)$m[1], 2);
        $proteinUnit = $proteinUnit ?: (isset($m[2]) && $m[2] !== "" ? strtolower((string)$m[2]) : null);
    }
    $fat = $recipe->fat;
    $fatUnit = $recipe->fat_unit;
    if($fat === null && preg_match('/([0-9]+(?:\.[0-9]+)?)\s*(g|mg|mcg|µg)?\s*(?:of\s+)?fat\b/i', $summary, $m) && is_numeric($m[1])){
        $fat = round((float)$m[1], 2);
        $fatUnit = $fatUnit ?: (isset($m[2]) && $m[2] !== "" ? strtolower((string)$m[2]) : null);
    }
    $recipe->summary = $recipe->summary ?: $summary;
    $recipe->instructions = $recipe->instructions ?: ($instructions !== "" ? $instructions : null);
    $recipe->dish_types = (is_array($recipe->dish_types) && $recipe->dish_types !== []) ? $recipe->dish_types : (array)($data["dishTypes"]??[]);
    $recipe->diets = (is_array($recipe->diets) && $recipe->diets !== []) ? $recipe->diets : (array)($data["diets"]??[]);
    $recipe->calories = $calories;
    $recipe->protein = $protein;
    $recipe->protein_unit = $proteinUnit;
    $recipe->fat = $fat;
    $recipe->fat_unit = $fatUnit;
    $recipe->save();
    $updated++;
}
echo json_encode(["checked" => $recipes->count(), "updated" => $updated]);
