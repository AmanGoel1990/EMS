<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PdfController extends Controller
{
    public function showPdf($filename)
    {
        $filePath = storage_path('app\public' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }
    }

    public function downloadPdf($filename)
    {
        $filePath = storage_path('app\public' . $filename);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
    }
}
