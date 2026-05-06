<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Пошта жіберу функциясы.
     */
    public function sendEmail()
    {
        $mailData = [
            'title' => 'Жаңа жаттығу жүктелді!',
            'body' => 'GymHub платформасына жаңа жаттығу бағдарламасы қосылды. Қарап шығыңыз және бағалаңыз.',
            'subject' => 'New Workout Submission — GymHub'
        ];

        // Поштаны жіберу
        Mail::to('user@example.com')->send(new DemoEmail($mailData));

        return back()->with('success', 'Email sent to Gym Member!');
    }
}
