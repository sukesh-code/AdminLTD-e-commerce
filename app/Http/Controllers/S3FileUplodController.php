<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class S3FileUplodController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // Max file size: 10MB
        ]);

        $file = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('uploads', [
            'disk' => 's3',
            'visibility' => 'public',
        ]);

        return response()->json(['message' => 'File uploaded successfully', 'path' => $path], 200);
    }
}
