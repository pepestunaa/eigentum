<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FilePreviewController extends Controller
{
    public function show($file): BinaryFileResponse
    {
        // the route sits behind auth middleware; belt-and-braces for internal calls
        if (!Auth::check()) {
            abort(403);
        }

        // reject traversal attempts and absolute/backslash paths outright
        if (str_contains($file, '..') || str_contains($file, '\\') || str_starts_with($file, '/')) {
            abort(404);
        }

        $filePath = public_path('storage/' . $file);

        if (!is_file($filePath)) {
            abort(404);
        }

        return response()->file($filePath, ['Content-Disposition' => 'inline']);
    }
}
