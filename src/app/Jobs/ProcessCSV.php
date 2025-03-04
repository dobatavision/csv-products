<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use App\Models\Upload;
use Illuminate\Support\Facades\Log;

class ProcessCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $filePath;
    protected $upload;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath, Upload $upload)
    {
        $this->filePath = $filePath;
        $this->upload = $upload;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->upload->update(['status' => 'processing']);
        Log::info('CSV processing started for file: ' . $this->filePath);

        try {
            $file = fopen($this->filePath, 'r');
            $header = fgetcsv($file);

            // Validate CSV header
            $requiredColumns = ['name', 'description', 'price'];
            if ($header === false || array_diff($requiredColumns, $header)) {
                $errorMessage = 'Invalid CSV format. Required columns: ' . implode(', ', $requiredColumns);
                Log::error($errorMessage);
                throw new \Exception($errorMessage);
            }

            $rowCount = 0;

            while ($row = fgetcsv($file)) {
                $data = array_combine($header, $row);

                // Validate row data
                if (!$data || !isset($data['name'], $data['description'], $data['price'])) {
                    $errorMessage = 'Invalid CSV row format at row ' . ($rowCount + 2);
                    Log::error($errorMessage);
                    throw new \Exception($errorMessage);
                }

                Product::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'user_id' => $this->upload->user_id,
                ]);

                $rowCount++;

                // Sleep for 2 seconds after every 200 rows to save mysql DB from crashing :)
                if ($rowCount % 200 == 0) {
                    Log::info($rowCount . ' rows inserted. Sleeping for 2 seconds...');
                    sleep(2);
                }
            }

            fclose($file);
            $this->upload->update(['status' => 'completed']);
            Log::info('CSV processing completed for file: ' . $this->filePath);
        } catch (\Exception $e) {
            $this->upload->update(['status' => 'failed']);
            $errorMessage = 'CSV processing failed for file: ' . $this->filePath . ' with error: ' . $e->getMessage();
            Log::error($errorMessage);
        }
    }

    /**
     * Get the upload instance.
     *
     * @return Upload
     */
    public function getUpload()
    {
        return $this->upload;
    }
}
