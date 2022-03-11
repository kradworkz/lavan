<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\PatientAdmission;
use Illuminate\Console\Command;
use App\Services\SMSGateway;

class CheckOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Patient Checkout';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SMSGateway $sms)
    {
        $lists = PatientAdmission::with('facility.bed.facility')->with('patient')
        ->where('is_released',0)
        ->where('completion_at',today())->get();
        foreach($lists as $list){  
            if($list->is_home){
                $message = 'Good day, '.$list->patient->firstname.' '.$list->patient->lastname.'. Your quarantine period has ended. Keep safe always..                                 
                
-Rural Health Unit

Thank you!';
                $sms->sendSMS($message, $list->patient->mobile);
            }else{
                $message = 'Good day, '.$list->patient->firstname.' '.$list->patient->lastname.'. Your quarantine period has ended.';
                $sms->sendSMS($message, $list->patient->mobile);
    
                $municipality_id = $list->patient->barangay->municipality_id;
                $user = User::where('type','Isolation Manager')->where('municipality_id',$municipality_id)->first();
                
                $message = 'Good day, '.$user->name.'! Patient '.$list->patient->firstname.' '.$list->patient->lastname.' at '.$list->facility->bed->facility->name.' on floor '.$list->facility->bed->floor.' room '.$list->facility->bed->name.', will be released today. Kindly Assist the patient, Thank you!';
                $sms->sendSMS($message, $user->mobile);
            } 
        }
    }
}
