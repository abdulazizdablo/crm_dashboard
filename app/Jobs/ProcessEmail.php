<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectAssigned;
use App\Models\Task;
use App\Notifications\TaskAssigned;


class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user, public $model)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
      if($this->model instanceof Task){
        $this->user->notify(new TaskAssigned($this->model));


      }
      else


        Mail::to($this->user)->send(new ProjectAssigned($this->model));
    }
}
