<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Publisher;

class Book extends Model
{
    use HasFactory;

    // returnina autoriu, kuris turi ta knyga
    public function bookAuthor() //pavadinimas funkcijos cia nieko nereiskia
     {
        //surisiams tarp book author_id ir author id
        return $this->belongsTo(Author::class, 'author_id', 'id');
        // si knyga priklauso autoriui pagal author_id, ir id priklausuomybe
     }
     
    public function bookPublisher() //pavadinimas funkcijos cia nieko nereiskia
     {
        //surisiams tarp book author_id ir author id
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
        // si knyga priklauso autoriui pagal author_id, ir id priklausuomybe
     }

}
