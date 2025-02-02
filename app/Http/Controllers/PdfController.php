<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function downloadPdf()
    {
        $file = $_GET['file'];
        $filePath = storage_path('app/public/' . $file);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found!'], 404);
        }

        return response()->download($filePath);
    }
}
