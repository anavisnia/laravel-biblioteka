<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Publisher;

class Publisher extends Model
{
    use HasFactory;

    public function publisherBooksList()
    {
        return $this->hasMany('App\Models\Book', 'publisher_id', 'id');
    }

    public static function new()
    {
        return new self;
    }

    public function refreshAndSave(Request $request)
    {
        $this->title = $request->publisher_title;
        $this->save();
        return $this;
    }
}
