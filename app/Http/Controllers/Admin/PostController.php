<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use RahulHaque\Filepond\Facades\Filepond;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Nome'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Classificação Indicativas'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Categoria'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Nota'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2', 'name' => 'Aceitação'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2', 'name' => 'Status'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.post.index', compact('ths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        if (Gate::denies('create', Auth::user())) {
            abort(403);
        }

        try {
            $validated = $request->validated();
            $post = Auth::user()->posts()->create(Arr::except($validated, ['images']));

            if (isset($validated['images'])) {
                foreach ($validated['images'] as $key => $image) {
                    $postName = 'post_'.$post->id.'_'.$key;
                    $fileInfos = Filepond::field($image)
                        ->moveTo('posts/' . $postName);
                    $post->images()->create([
                        'name' => 'posts/' . $postName
                    ]);
                }
            }
            return redirect()->route('admin.posts.index')->with('success', 'Post criada com sucesso!');
        }catch (\Exception $e) {
            return redirect()->route('admin.posts.create')->with('danger', 'Não foi possível criar o post!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.post.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
