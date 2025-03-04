<?php

namespace App\Listeners;

use Illuminate\Queue\Events\JobProcessed;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\BasicMailable;

class SendEmailAfterJobProcessed
{
    /**
     * Handle the event.
     *
     * @param  JobProcessed  $event
     * @return void
     */
    public function handle(JobProcessed $event)
    {
        $job = $event->job;

        if ($job->resolveName() === 'App\Jobs\ProcessCSV') {
            $data = $job->payload();
            $command = unserialize($data['data']['command']);
            $upload = $command->getUpload();
            $status = $upload->status;

            $user = User::find($upload->user_id);

            $details = [
                'name' => $user->name,
                'status' => $status,
                'file_path' => $upload->file_path,
            ];

            Mail::to($user->email)->send(new BasicMailable($details));
            Log::info('Email sent to ' . $user->email . ' with status: ' . $status);
        }
    }
}
