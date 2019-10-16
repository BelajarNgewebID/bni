<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $req) {
        $create = Tag::create([
            'tags' => $req->tags,
            'used' => 1
        ]);
    }
    public function search(Request $req) {
        // 
    }
    public function use($id) {
        $tag = Tag::find($id)->update();
    }
}
