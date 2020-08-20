<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
        	'name' => 'Laravel 7',
        	'slug' => Str::slug('Laravel 7')
        ]);

        Channel::create([
        	'name' => 'Vue 7',
        	'slug' => Str::slug('Vue 7', '-'),
        ]);

        Channel::create([
        	'name' => 'Angular 7',
        	'slug' => Str::slug('Angular 7', '-'),
        ]);

        Channel::create([
        	'name' => 'Java Script 7',
        	'slug' => Str::slug('Java Script 7', '-'),
        ]);
    }
}
