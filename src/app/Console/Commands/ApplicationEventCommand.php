<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ApplicationEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:new {--type=} {--T|title=} {--B|body=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger a new Application Event';

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
     * @return mixed
     */
    public function handle()
    {
        $eventData = (object)[
            'type' => $this->option('type') ?? 'EVENT',
            'title' => $this->option( 'title' ) ?? 'A title',
            'body' => $this->option('body') ?? 'A body',
        ];
        event(new \App\Events\ApplicationEvent($eventData));
    }
}
