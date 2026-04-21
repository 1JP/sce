<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\SentimentService;
use Illuminate\Http\Request;

class SiteCommentController extends Controller
{
    private $huggingface;

    public function __construct(SentimentService $huggingface)
    {
        $this->huggingface = $huggingface;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        try {
            $validated = $request->validated();
            $commentAnalysis = $this->huggingface->analyze($validated['description']);
            $validated['sentiment'] = $commentAnalysis->label;
            $validated['user_id'] = $validated['user_id'] ?? auth()->id();

            Comment::updateOrCreate(
                [
                    'comment_id' => $validated['comment_id'] ?? null,
                    'post_id' => $validated['post_id'],
                    'description' => $validated['description'],
                    'user_id' => $validated['user_id'],

                ],
                $validated
            );

            return redirect()->back()->with('success', 'Comentário criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Ocorreu um erro ao analisar o sentimento do comentário: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
