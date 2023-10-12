<?php

namespace App\Http\Controllers;

use App\Models\Newspost;
use Illuminate\Http\Request;

class NewsPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Newspost::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'details' => 'required|string',
            'category' => 'required|string', 
            'custom_url' => 'required|string|unique:App\Models\Newspost,custom_url',
            'tags' => 'required|string',
            'story_external_source_name' => 'required|string',
            'story_external_source_url' => 'required|string',
            'image_external_source_credit' => 'required|string',
            'image_external_source_url' => 'required|string',
        ]);
  
        // Retrieve the currently authenticated user's ID...
        $user_id = Auth::id();
  
        return Newspost::create([
            'title' => $request->input('title'),
            'details' => $request->input('details'),
            'category' => $request->input('category'),
            'user_id' => $user_id,
            'custom_url' => $request->input('custom_url'),
            'tags' => $request->input('tags'),
            'story_external_source_name' => $request->input('story_external_source_name'),
            'story_external_source_url' => $request->input('story_external_source_url'),
            'image_external_source_credit' => $request->input('image_external_source_credit'),
            'image_external_source_url' => $request->input('image_external_source_url')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Newspost::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // First get the news based on the ID
        $news = Newspost::findOrFail($id);

        // Then update it.
        $news->update($request->all());

        // Now return the updated news
        return $news;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    // Get the API data to be deleted
    $the_deleted_data = Newspost::findOrFail($id);

    // Delete a news item or entry
    Newspost::destroy($id);

    // Return a copy of the deleted data
    return $the_deleted_data;
    }

    public function search($searchPhrase)
    {
        return Newspost::where('title', 'like', '%' . $searchPhrase . '%')->get();
    }

}
