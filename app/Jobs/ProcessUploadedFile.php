<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable as BusQueueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\File;
use App\Services\HuggingFaceService;

class ProcessUploadedFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public File $file) {
        //
    }

    public function handle(HuggingFaceService $hf): void {
        $this->file->update(['status' => 'processing']);

        try {
            $result = $hf->query('facebook/bart-large-cnn', [
                'inputs' => "Analyse du fichier {$this->file->filename}"
            ]);

            $this->file->insights()->create([
                'type' => 'summary',
                'content' => $result,
                'summary' => $result[0]['summary_text'] ?? null,
                'confidence' => 0.9
            ]);

            $this->file->update(['status' => 'done']);
        } catch (\Exception $e) {
            $this->file->update(['status' => 'failed']);
        }
    }
}
