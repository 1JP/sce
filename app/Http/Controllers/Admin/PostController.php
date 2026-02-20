<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Arr;
use RahulHaque\Filepond\Facades\Filepond;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
                        'name' => $fileInfos['location']
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
    public function edit(Post $post)
    {
        $post->images = $post->images->map(function($item){
            $item->link = asset('storage').'/'.$item->name;
            return $item;
        });

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        if (Gate::denies('update', Auth::user())) {
            abort(403);
        }

        try {
            $validated = $request->validated();
            $post->update(Arr::except($validated, ['images']));

            if (isset($validated['images'])) {
                $post->images->map(function($item){
                    if (Storage::disk('public')->exists($item->name)) {
                        Storage::disk('public')->delete($item->name);
                    }
                });
                $post->images()->delete();
                foreach ($validated['images'] as $key => $image) {
                    $postName = 'post_'.$post->id.'_'.$key;
                    $fileInfos = Filepond::field($image)
                        ->moveTo('posts/' . $postName);

                    $post->images()->create([
                        'name' => $fileInfos['location']
                    ]);
                }
            }
            return redirect()->route('admin.posts.index')->with('success', 'Post atualizada com sucesso!');
        }catch (\Exception $e) {
            return redirect()->route('admin.posts.create')->with('danger', 'Não foi possível atualizar o post!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Gate::denies('delete', Auth::user())) {
            abort(403);
        }

        try {
            if($post->images()->count() > 0){
                $post->images->map(function($item){
                    if (Storage::disk('public')->exists($item->name)) {
                        Storage::disk('public')->delete($item->name);
                    }
                });
                $post->images()->delete();
            }

            $post->delete();
            return redirect()->route('admin.posts.index')->with('success', 'Post deletado com sucesso!');
        }catch (\Exception $e) {
            return redirect()->route('admin.posts.create')->with('danger', 'Não foi possível deletar o post!');
        }
        
    }
}
