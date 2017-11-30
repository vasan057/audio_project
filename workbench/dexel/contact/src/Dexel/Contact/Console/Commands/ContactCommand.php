<?php namespace Dexel\Contact\Console\Commands;

use Illuminate\Console\Command;

/**
 * The ContactCommand class.
 *
 * @package Dexel\Contact
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class ContactCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dexel:contact';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command for Dexel\Contact package';

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
        $this->info('Welcome to command for Dexel\Contact package');
    }
}
