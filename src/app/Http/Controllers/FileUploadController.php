<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCSV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FileUploadController extends Controller
{
    use AuthorizesRequests;

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:20480', // 20MB
        ]);

        $file = $request->file('file');
        $filePath = $file->storeAs('uploads', time().'_'.Auth::id().'_products.csv', 'public');
        // $filePath = $file->storeAs('uploads', 'products.csv', 'public');

        // Create an upload record
        $upload = Upload::create([
            'user_id' => Auth::id(),
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        // Process the CSV file
        ProcessCSV::dispatch(storage_path('app/public/' . $filePath), $upload);

        return response()->json(['message' => 'File uploaded and will be imported from Queue process !!!']);
    }
}
