<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Validator;

class PublisherController extends Controller
{
     //be login negalima prieti prie create/read/update/deleate
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //kolekcija
        // $publishers = publisher::all();
        //rusiavimas
        // $publishers = $request->sort ? publisher::orderBy('surname')->get() : publisher::all();
        if('title' === $request->sort) {
            $publishers = Publisher::orderBy('name')->get();
        } else {
            $publishers = Publisher::all();
        }
        // $publishers = publisher::orderBy('surname')->get();
        return view('publisher.index', ['publishers' => $publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'publisher_title' => ['required', 'min:3', 'max:64'],
        ],
        [
            'publisher_title.required' => 'Please fill the title',
            'publisher_title.min' => 'per trumpas'
        ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        // publisher::create($request);
        Publisher::new()->refreshAndSave($request);
        return redirect()->route('publisher.index')->
        with('success_message', 'publisher has been successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('publisher.edit', ['publisher' => $publisher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $validator = Validator::make($request->all(),
        [
            'publisher_title' => ['required', 'min:3', 'max:64'],
        ],
        [
            'publisher_title.required' => 'Please fill the title',
        ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        // $publisher->edit($request);
        $publisher->refreshAndSave($request);
        return redirect()->route('publisher.index')->
        with('info_message', 'publisher has been successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        if($publisher->publisherBooksList->count() !== 0) {
            return redirect()->route('publisher.index')->
        with('info_message', 'publisher cannot be deleted because there are some books written!');
        }
        $publisher->delete();
        return redirect()->route('publisher.index')->
        with('info_message', 'publisher has been successfully deleted!');
    }
}
