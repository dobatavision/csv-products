<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\BasicMailable;
use App\Models\Upload;
use App\Models\User;

class csv_import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:csv_import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo(date('Y-m-d H:i:s', time()));
        // $upload = Upload::find(41);
        // // dd($upload->user_id);
        //     $user = User::find($upload->user_id);

        //     $details = [
        //         'name' => $user->name,
        //         'status' => 'superrrr',
        //         'file_path' => $upload->file_path,
        //     ];

        // $recipient = $user->email;
        // Mail::to($recipient)->send(new BasicMailable($details));


        // $this->sendEmailNotification('test csv import from command');
        // $file = request()->file('csv_file'); // Assuming the file input name is 'csv_file'
        // $file->storeAs('uploads', time().'_products.csv', 'public');
        // $file = fopen(storage_path('app/public/uploads/' . time() . '_products.csv'), 'w');
        // fclose($file);
        dump('Importing CSV file...');
    }

    /**
     * Send email notification.
     *
     * @param string $status
     */
    protected function sendEmailNotification(string $status): void
    {
        $user = $this->upload->user;
        $details = [
            'name' => $user->name,
            'status' => $status,
            'file_path' => $this->filePath,
        ];

        Mail::to($user->email)->send(new BasicMailable($details));
    }
}
