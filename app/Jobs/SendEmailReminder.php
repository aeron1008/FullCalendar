<?php

namespace App\Jobs;

use App\Models\Terminu;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class SendEmailReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $terminu;

    /**
     * Create a new job instance.
     */
    public function __construct($email, Terminu $terminu)
    {
        $this->email = $email;
        $this->terminu = $terminu;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'name' => $this->terminu->pacjent->name,
            // 'clinic_name' => $this->terminu->zaposlenik->clinic_name,
            // 'clinic_address' => $this->terminu->zaposlenik->clinic_address,
            'start_time' => $this->terminu->start_time,
            'end_time' => $this->terminu->finish_time,
        ];

        try {
            Mail::send('mail', $data, function ($message) {
                $message->to($this->email, $this->terminu->pacjent->name)->subject('Appointment Booking');
            });
        } catch (Exception $e) {
            // Log the error and send a notification to the administrator
            Log::error('Email sending failed: ' . $e->getMessage());
            
            // Send a notification to the administrator using your preferred method (e.g., email, Slack, etc.)
            // ...
        }
    }
}