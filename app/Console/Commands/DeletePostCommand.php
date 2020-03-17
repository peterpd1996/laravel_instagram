<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;
use Carbon\Carbon;
class DeletePostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   // protected $signature = 'command:delete-post {date}'; // ? nghia la co the co hoac khong
    
//    protected $signature = 'command:delete-post {post} ${title?}'; // ? nghia la co the co hoac khong
    
    protected $signature = 'command:delete-post';


    /**
     * The console command description.
     *
     * @var string
     */
    private $post;
    protected $description = 'Delete a post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      
       $post_id =  $this->ask('which post do you want delete ?'); // mk se tra loi vao day va lay ket qua 
        try{
           $post = $this->post::find($post_id);
           $post->delete();

           $this->info('delete successfully');
           //$this->warn('This is a warning');
          } catch (\Exception $e) {
           // $this->error($e->getMessage());
            echo 'Error: ' . $e->getMessage(), PHP_EOL;
            echo 'Line: ' . $e->getLine(), PHP_EOL;
            echo 'File: ' . $e->getFile(), PHP_EOL;
        }
       
    }
}
