<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostImage;
use Illuminate\Support\Facades\Storage;

class PostImageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostImage $image)
    {
        $previousUrl = session()->get('_previous.url');

        try {
            if (Storage::disk('public')->exists($image->name)) {
                Storage::disk('public')->delete($image->name);
            }
            
            $image->delete();

            return response([
                'url' => $previousUrl,
                'menssage' => 'A foto foi excluida com sucesso'
            ], 200);

        }catch (\Exception $e) {
            return response(['error' => 'Não foi possível excluir o arquivo.'], 500);
        }
    }
}
