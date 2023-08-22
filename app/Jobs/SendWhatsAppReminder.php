<?php

namespace App\Jobs;

use App\Models\Terminu;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;

class SendWhatsAppReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone;
    protected $terminu;
    protected $clinic_name;
    protected $clinic_address;

    public function __construct($phone, Terminu $terminu , $clinic_name = null  , $clinic_address = null)
    {
        $this->phone = $phone;
        $this->terminu = $terminu;
        $this->clinic_name = $clinic_name;
        $this->clinic_address = $clinic_address;
    }

    public function handle()
{
    
    $curl = curl_init();

    $postData = '{
        "messaging_product": "whatsapp",
        "to": ' . $this->phone . ',
        "recipient_type": "individual",
        "type": "template",
        "template": {
            "name": "appointment_booking",
            "language": {
                "code": "hr"
            },
            "components": [
                {
                    "type": "header",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $this->clinic_name . '"
                        }
                    ]
                },
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . date('Y-m-d', strtotime($this->terminu->start_time)) . '"
                        },
                        {
                            "type": "text",
                            "text": "' . date('H:i:s', strtotime($this->terminu->start_time)) . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $this->clinic_address . '"
                        }
                    ]
                },
                {
                    "type": "button",
                    "sub_type": "url",
                    "index": "0",
                    "parameters": [
                        {
                            "type": "payload",
                            "payload": "cancel/appointment/' . $this->terminu->id . '"
                        }
                    ]
                }
            ]
        }
    }';

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://graph.facebook.com/v16.0/110667575342331/messages',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . config('app.wa_access_token'),
        ),
    ));

    $response = curl_exec($curl);

    \Log::info('WhatsApp API Response:', ['response' => $response]);
  \Log::info('WhatsApp API Response:', ['response' => $response]);
        \Log::info('WA_ACCESS_TOKEN:', ['token' => config('app.wa_access_token')]);
        \Log::info('Zaposlenik Data:', ['zaposlenik' => $this->terminu->zaposlenik]);
        \Log::info('User Data:', ['user' => $this->terminu->user]);
// \Log::info('Clinic Name:', ['clinic_name' => Auth::user()->clinic_name]);
// \Log::info('Clinic Address:', ['clinic_address' => Auth::user()->clinic_address]);

\Log::info('Start Time:', ['start_time' => date('Y-m-d', strtotime($this->terminu->start_time))]);
\Log::info('Start Time (Hour):', ['start_time_hour' => date('H:i:s', strtotime($this->terminu->start_time))]);
    curl_close($curl);
}

      



     
}