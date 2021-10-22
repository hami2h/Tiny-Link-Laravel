<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Auth;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->type == 'manager' || $user->type == 'admin') {
            $links = Link::get();
        } elseif ($user->type == 'user') {
            $links = Auth::user()->links;
        }

        return view('links.list', compact('links'));
    }

    public function remove($id)
    {
        $link = Link::findOrFail($id);
        $this->authorize('remove', $link);
        $link->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $link = Link::find($id);
        $this->authorize('edit', $link);
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $link = Link::findOrFail($id);
        $this->authorize('edit', $link);
        $link->url = $request->url;
        $link->save();
        return redirect()->route('links');
    }

    public function create()
    {
        $this->authorize('create', Link::class);
        return view('links.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Link::class);
        $url = $request->url;
        $user = Auth::user();
        $count = $user->links()->count() + 1;

        $result = Link::create([
            'url' => $url,
            'slug' => $user->id . uniqid() . $count,
            'user_id' => $user->id
        ]);


        if ($result) {
            return redirect()->route('links');
        }
    }

    public function changeState($id)
    {
        $link = Link::find($id);
        $this->authorize('changeState', $link);
        $link->active = !$link->active;
        $link->save();
        return redirect()->route('links');
    }

    public function show($linkid)
    {
        $link = Link::where('slug', $linkid)->first();
        if (!empty($link) && $link->active == true) {
            return redirect($link->url);
        }

        return abort(404);
    }
}
