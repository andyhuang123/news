<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Showmini extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mini:open {words}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时开启小程序页面';

    protected $words = '';
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
    public function handle(){    
        $words = $this->argument("words");
        if($words=='open'){
            DB::table('admin_config')->where('name', 'base.is_show')->update(['value'=>0]);
        }
        else if($words=='closed')
        {
            DB::table('admin_config')->where('name', 'base.is_show')->update(['value'=>1]);
        }
        
    }
}
