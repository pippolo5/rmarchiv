<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('games.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maker = \DB::table('makers')
            ->orderBy('makers.title')
            ->get();

        $langs = \DB::table('languages')
            ->orderBy('id')
            ->get();

        return view('games.create', ['makers' => $maker, 'langs' => $langs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'maker' => 'required|not_in:0',
            'language' => 'required|not_in:0',
            'developer' => 'required',
        ]);

        $devid = DatabaseHelper::developerId_from_developerName($request->get('developer'));
        if ($devid == 0) {
            $devid = DatabaseHelper::developer_add_and_get_developerId($request->get('developer'));
        }

        $langid = DatabaseHelper::langId_from_short($request->get('language'));

        $gameid = \DB::table('games')->insertGetId([
            'title' => $request->get('title'),
            'subtitle' => $request->get('subtitle', ''),
            'desc_md' => $request->get('desc'),
            'desc_html' => \Markdown::convertToHtml($request->get('desc')),
            'website_url' => $request->get('websiteurl', ''),
            'maker_id' => $request->get('maker'),
            'lang_id' => $langid,
            'user_id' => \Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        \DB::table('games_developer')->insert([
            'user_id' => \Auth::id(),
            'game_id' => $gameid,
            'developer_id' => $devid,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->action('MsgBoxController@game_add', [$gameid]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $game = \DB::table('games')
            ->leftJoin('users', 'games.user_id', '=', 'users.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->select([
                'games.id as gameid',
                'users.id as userid',
                'games.title',
                'games.subtitle',
                'makers.title as makertitle',
                'makers.short as makershort',
                'makers.id as makerid',
            ])
            ->where('games.id', '=', $id)
            ->first();

        $developer = \DB::table('developer')
            ->leftJoin('games_developer', 'developer.id', '=', 'games_developer.developer_id')
            ->where('games_developer.game_id', '=', $id)
            ->orderBy('games_developer.id')
            ->get();

        $content_type = 'game';

        $comments = \DB::table('comments')
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->select(['comments.id', 'comments.user_id', 'comments.comment_html', 'comments.created_at', 'users.name',
                'comments.vote_up', 'comments.vote_down'])
            ->where('content_type', '=', $content_type)
            ->where('content_id', '=', $id)
            ->orderBy('created_at', 'asc')->get();


        return view('games.show', [
            'game' => $game,
            'comments' => $comments,
            'developer' => $developer,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('games.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
