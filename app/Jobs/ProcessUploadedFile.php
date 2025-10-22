<?php

namespace App\Jobs;

use App\Models\File;
use App\Services\HuggingFaceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Smalot\PdfParser\Parser; // For PDF parsing

class ProcessUploadedFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public File $file) {}

    public function handle(HuggingFaceService $hf): void
    {
        $this->file->update(['status' => 'processing']);

        try {
            $path = storage_path('app/public/' . $this->file->path);

            if (!file_exists($path)) {
                \Log::error("File not found: {$path}");
                $this->file->update(['status' => 'failed']);
                return;
            }

            // --- Extract text based on file type ---
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $content = '';

            if (in_array($extension, ['txt', 'csv', 'json'])) {
                $content = file_get_contents($path);
            } elseif ($extension === 'pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($path);
                $content = $pdf->getText();
            } elseif (in_array($extension, ['jpg','jpeg','png','gif'])) {
                // Optional: use OCR here (Tesseract or HuggingFace image-to-text)
                $content = 'Extracted text from image (implement OCR)';
            } else {
                $content = 'Unsupported file type for summarization';
            }

            $content = trim($content);

            if (empty($content) || strlen($content) < 10) {
                \Log::warning("Content too short for summarization: {$this->file->filename}");
                $this->file->insights()->create([
                    'type' => 'summary',
                    'content' => $content,
                    'summary' => 'Content too short for summary',
                    'confidence' => 0
                ]);
                $this->file->update(['status' => 'done']);
                return;
            }

            // --- Call HuggingFace summarization model ---
            $result = $hf->query('facebook/bart-large-cnn', [
                'inputs' => $content
            ]);

            \Log::info('HF API result:', (array) $result);

            $summaryText = $result[0]['summary_text'] ?? 'Summary could not be generated';

            // --- Save insight ---
            $this->file->insights()->create([
                'type' => 'summary',
                'content' => $content,
                'summary' => $summaryText,
                'confidence' => 0.9
            ]);

            $this->file->update(['status' => 'done']);

        } catch (\Exception $e) {
            \Log::error('File processing failed: ' . $e->getMessage());
            $this->file->update(['status' => 'failed']);
        }
    }
}
