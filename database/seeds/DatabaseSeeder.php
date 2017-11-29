<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(\App\Models\Profile::class,6)->create();
        factory(\App\Models\WorkProfile::class,6)->create();
        factory(\App\Models\EducationProfile::class,6)->create();*/
	    
        factory(App\User::class, 6)
			    ->create()
			    ->each(function ($u) {
				    $u->profile()->save(factory(\App\Models\Profile::class)->make());
				    $u->workProfile()->save(factory(\App\Models\WorkProfile::class)->make());
				    $u->educationProfile()->save(factory(\App\Models\EducationProfile::class)->make());
			    });
    }
}
