<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Mail;
use App\Models\Terminu;
use App\Jobs\SendEmailReminder; 
use App\Jobs\SendWhatsAppReminder;
use App\Models\User;

class NotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:cron';

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
        date_default_timezone_set("Europe/Ljubljana");
        $now = date("Y-m-d H:i");
        $terminus = Terminu::where('start_time', '>=', Carbon::now()->timezone('Europe/Ljubljana')->subMinutes(1440))->get();

        foreach ($terminus as $terminu) {
            $perday = date('Y-m-d H:i', strtotime($terminu->start_time . ' -24 hours'));
            $perhour = date('Y-m-d H:i', strtotime($terminu->start_time . ' -1 hours'));

            if($terminu->id == 82){
                Terminu::where('id', 82)->update(['komentar' => $perhour ." || ". $now]);
            }
            
            if ($perday == $now) {
                SendWhatsAppReminder::dispatch($terminu->pacjent->country_code.$terminu->pacjent->phone, $terminu , User::find(1)->clinic_name , User::find(1)->clinic_address);
                SendEmailReminder::dispatch($terminu->pacjent->email, $terminu);
            }

            if ($perhour == $now) {
                SendWhatsAppReminder::dispatch($terminu->pacjent->country_code.$terminu->pacjent->phone, $terminu , User::find(1)->clinic_name , User::find(1)->clinic_address);
                SendEmailReminder::dispatch($terminu->pacjent->email, $terminu);
            }
        }
    }

}
