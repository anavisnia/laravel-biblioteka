<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Author extends Model
{
    use HasFactory;

    // public static function create(Request $request)
    // {
    //     $author = new self;
    //     $author->name = $request->author_name;
    //     $author->surname = $request->author_surname;
    //     $author->save();
    // }

    // public function edit(Request $request)
    // {
    //     $this->name = $request->author_name;
    //     $this->surname = $request->author_surname;
    //     $this->save();
    // }

    // rysis, autorius kuris turi daug knygu
    public function authorBooksList()
    {
        return $this->hasMany('App\Models\Book', 'author_id', 'id');
    }

    public static function new()
    {
        return new self;
    }

    public function refreshAndSave(Request $request)
    {
        
        $file = $request->file('author_portret'); // is request/siuntimo paima failo aprasa
        if(!empty($file)) {
            $name = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension(); // is failo apraso pasiimam originalu pavadinima
            // $name = rand(1000000000, 9999999999).'.'.$file->getClientOriginalExtension(); //random vardas
            $file->move(public_path('img'), $name); // movinam is tmp folderio i public folder - img
            $this->portret = 'http://bib.com/img/'.$name; // irasom i db + url kelias iki paveiksliuko
        }
        $this->name = $request->author_name;
        $this->surname = $request->author_surname;
        $this->save();
        return $this;
    }
}
