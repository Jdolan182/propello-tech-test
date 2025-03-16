<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tags = auth()->user()?->tags ?? [];

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTagRequest $request): RedirectResponse
    {
        //
        Tags::query()->create(
            array_merge(
                $request->validated(),
                ['user_id' => auth()->user()->id]
            )
        );

        flash('Tag has been created');

        return redirect()->to(route('tags.index'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(tags $tags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tags $tag)
    {
        //
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, tags $tag)
    {
        //
        $tag->update($request->validated());

        flash('Tag has been updated');

        return redirect()->to(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tags $tag)
    {        
        //
        $tag->delete();

        flash('Tag has been deleted');

        return redirect()->to(route('tags.index'));
    }
}
