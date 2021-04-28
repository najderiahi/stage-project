<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateTasks extends Model
{
    use HasFactory;

    public function __invoke($schedule)
    {
        return function () use ($schedule) {
            $results = DB::table('CUSTMSTR')->select('CUST_UDF2', 'CLIENTNAME')->where('CUSTGROUP', '3PL')->distinct()->get();
            Task::insert($results->map(fn ($item) => array_merge(get_object_vars($item), ["ROWID" => (string)Str::uuid()]))->toArray());
            $tasks = Task::all();
            $tasks->each(
                function ($task) use ($schedule) {
                    if (Str::of($task->CUST_UDF2)->trim()->isNotEmpty()) {
                        $schedule->call($task->execute)->cron($task->frequency);
                    } else {
                        $task->execute();
                    }
                });
        };
    }
}
