<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ArticleController extends Controller //implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view article', only: ['index']),
            new Middleware('permission:edit article', only: ['edit']),
            new Middleware('permission:update article', only: ['create']),
            new Middleware('permission:delete article', only: ['delete']),
        ];
    }

    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('article.index', compact('articles'));
    }

    public function create()
    {
        $articles = Article::all();
        return view('article.create', compact('articles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:articles',
            'content' => 'max:255',
            'author' => 'required',
        ]);

        if ($validator->passes()) {
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
            ]);
            return redirect()->route('article.index')->with('success', 'Article created successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', [
            'article' => $article,
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'max:255',
            'author' => 'required',
        ]);
        if ($validator->passes()) {
            $article = Article::findOrFail($request->id);
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
            ]);
            return redirect()->route('article.index')->with('success', 'Article updated successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function delete($id)
    {
        Article::findOrFail($id)->delete();
        return response()->json([
            'success' => 'Roles Deleted Successfully',
        ]);
    }
}
