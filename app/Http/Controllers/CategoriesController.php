<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    protected $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function index() {
        $categories = Category::all();

        return $categories;
    }

    public function get($id) {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria não encontrada.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    public function store(Request $request) {
        Category::create($request->all());

        return response()->json(['message' => 'Categoria criada com sucesso']);
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria não encontrada.'
            ], 404);
        }

        $updated = $category->update($request->all());

        if ($updated) {
            return response()->json(['message' => 'Categoria atualizada com sucesso!']);
        }


    }
}
