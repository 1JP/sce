<?php

namespace App\Http\Controllers\Admin;

use App\Actions\PostAction;
use App\Actions\UpdatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Arr;
use RahulHaque\Filepond\Facades\Filepond;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Action responsible for handling post creation logic.
     *
     * @var PostAction
     */
    private $actionPost;

    /**
     * Action responsible for handling post update logic.
     *
     * @var UpdatePostAction
     */
    private $updateActionPost;

    /**
     * Class constructor to initialize the actions for PostAction and UpdatePostAction.
     *
     * @param PostAction $actionPost              The action used to handle post creation.
     * @param UpdatePostAction $updateActionPost  The action used to handle post update.
     */
    public function __construct(PostAction $actionPost, UpdatePostAction $updateActionPost)
    {
        $this->actionPost = $actionPost;
        $this->updateActionPost = $updateActionPost;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

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
        $this->authorize('create', Post::class);

        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->authorize('create', Auth::user());
        
        try {
            $validated = $request->validated();
            
            $post = $this->actionPost->execute(Auth::user(), Arr::except($validated, ['images']));

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
        $this->authorize('view', $post);

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

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
        $this->authorize('update', $post);

        try {
            $validated = $request->validated();
            $updateActionPost = $this->updateActionPost->execute(Auth::user(), $post, Arr::except($validated, ['images']));

            if (isset($validated['images'])) {
                $updateActionPost->images->map(function($item){
                    if (Storage::disk('public')->exists($item->name)) {
                        Storage::disk('public')->delete($item->name);
                    }
                });
                $updateActionPost->images()->delete();
                foreach ($validated['images'] as $key => $image) {
                    $postName = 'post_'.$updateActionPost->id.'_'.$key;
                    $fileInfos = Filepond::field($image)
                        ->moveTo('posts/' . $postName);

                    $updateActionPost->images()->create([
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
        $this->authorize('delete', $post);

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
