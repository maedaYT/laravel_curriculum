<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // モデルに対してクエリビルダを作成し、$query変数に代入してこのクエリビルダを使ってデータベースクエリを構築
        $query = Post::query();

        // 部分一致検索 (タイトル, 内容, 住所)
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('comment')) {
            $query->where('comment', 'like', '%' . $request->comment . '%'); // commentカラムがユーザーの入力したキーワードを部分一致で含む場合に検索条件を追加。％はワイルドカード文字で任意の文字列を表す。
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        // チェックイン・チェックアウト範囲
        if ($request->filled('check_in_date')) {
            $query->where('check_in_date', '<=', $request->check_in_date);
        }

        if ($request->filled('check_out_date')) {
            $query->where('check_out_date', '>=', $request->check_out_date);
        }

        // 金額範囲
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 検索結果を取得
        $posts = $query->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 投稿画面表示
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 投稿内容保存処理
        $post = Post::create([
            'title' => $request->title,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guest_count' => $request->guest_count,
            'comment' => $request->comment,
            'image' => $request->image,
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        // ビューから渡されたIDの記事を取得
        $post = Post::find($id);

        // 記事詳細画面を表示
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
