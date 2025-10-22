<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\File;

class ReportController extends Controller
{
    public function store(Request $request, File $file)
    {
        Report::create([
            'user_id' => auth()->id(),
            'file_id' => $file->id,
            'reason'  => $request->reason,
        ]);

        return response()->json(['success' => true]);
    }
}
