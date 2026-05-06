<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    /**
     * Файлды жүктеу формасын көрсету.
     */
    public function index()
    {
        // public/uploads/gym қалтасындағы барлық файлдарды алу
        $files = Storage::disk('public')->files('uploads/gym');
        
        return view('upload', compact('files'));
    }

    /**
     * Файлды сақтау.
     */
    public function store(Request $request)
    {
        // Валидация: файл болуы керек, түрі png, jpg, pdf, docx, көлемі макс 10MB
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,jpeg,pdf,docx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // storage/app/public/uploads/gym қалтасына сақтау
            $path = $file->storeAs('uploads/gym', $fileName, 'public');

            return back()->with('success', __('messages.log.upload_success', ['name' => $fileName]));
        }

        return back()->with('error', __('messages.log.upload_error'));
    }
}
