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
    public function index(Request $request)   // TOPページ表示
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
    public function create()   // 新規投稿作成画面の表示
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
    public function store(Request $request)   // 新規投稿の保存
    {
        // 投稿内容保存処理
        $post = Post::create([
            'user_id' => Auth::id(),   // ログインユーザーのIDを保存
            'post_id' => $request->post_id,
            'title' => $request->title,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guest_count' => $request->guest_count,
            'comment' => $request->comment,
            'image' => $request->image->store('images', 'public'),   // 画像保存
        ]);

        Auth::user()->update(['last_post_at' => now()]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)   // 個別の投稿ページの表示
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
    public function edit($id)   // 投稿編集画面の表示
    {
        // findOrFailで該当の投稿を取得
        $post = Post::findOrFail($id);
        return view('reservations.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)   // 投稿の更新の保存
    {
        // 編集画面からPUTメソッドで送信されたデータを受け取り、findOrFailで該当の予約を取得
        // updateメソッドで特定のカラムを更新
        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'check_in_date', 'check_out_date', 'guest_count', 'price', 'comment']));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $post->update(['image_url' => $path]);
        }

        return redirect()->route('mypage.index')->with('success', '投稿情報を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)   // 投稿を削除
    {
        // 削除確認画面からDELETEメソッドで送信されたデータを受け取り、findOrFailで該当の予約を取得
        // deleteメソッドでデータを削除
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('mypage.index')->with('success', '投稿を削除しました！');
    }

}
