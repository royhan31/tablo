<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(10);
        return view('news', [
            'news' => $news,
            'total' => $news->total(),
            'perPage' => $news->perPage(),
            'currentPage' => $news->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $news = new News();

        $news->title = $request->title;
        $news->content = $request->content;
        $news->description = $request->description;
        $news->image = $request->file('image')->store('news');

        $news->save();
        return redirect()->route('news')->with('success','Item created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('news-edit', [
            'news' => $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $news = News::find($id);

        $news->title = $request->title;
        $news->content = $request->content;
        $news->description = $request->description;
        if ($request->image != null) {
            Storage::delete($news->image);
            $news->image = $request->file('image')->store('news');  
        }
        $news->save();
        return redirect()->route('news')->with('success','Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        Storage::delete($news->image);
        $news->delete();
        return redirect()->route('news')->with('success','Item deleted successfully!');
    }
}
