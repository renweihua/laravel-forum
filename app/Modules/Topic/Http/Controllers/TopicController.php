<?php

namespace App\Modules\Topic\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Topic\Entities\Topic;
use App\Modules\User\Entities\UserInfo;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class TopicController extends TopicModuleController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $topics = Topic::getAllTopics();
        return view('topic::index', compact('topics'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($topic_id, Request $request)
    {
        $topic = Topic::find($topic_id);

        $dynamics = Dynamic::public()
            ->filter($request->all())
            ->where('topic_id', $topic_id)
            ->orderBy('dynamic_id', 'DESC')
            ->paginate(10);

        return view('topic::show', compact('topic', 'dynamics'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('topic::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('topic::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
