<?php

use Illuminate\Database\Seeder;

use App\User;

use App\Residence;

use App\Photo;

use App\Description;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        
        Residence::truncate();
        
        Photo::truncate();
        
        Description::truncate();
        
        factory(User::class, 1000)->create()->each(
        
            function($u){
                
                $r = factory(Residence::class)->make();
                
                $u->addResidence($r);
                
                $p = factory(Photo::class)->make();
                
                $r->addPhoto($p);
                
                $d = factory(Description::class)->make();
                
                $r->addDescription($d);
            }
        
        );
        
    }
}
