<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$GenreArray=array('Horror drama','Melodrama','Romantic drama','Action','Comedy-drama','Crime drama','Docudrama','Historical period drama','Legal drama','Melodrama');

       for ($i=0; $i < count($GenreArray); $i++) { 
	    	Genre::create([
	            'name' => $GenreArray[$i]
	        ]);
    	}
    }
}
