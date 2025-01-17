<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;  // ログイン中のユーザーIDを取得する場合はこれがないとユーザID取得できない

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // リクエストからpost_idを取得し、Postモデルから該当する旅館データを取得
        $post = Post::findOrFail($request->post_id);
        // ビューに$post変数を渡す
        return view('reservations.create', compact('post'));
    }

    // public function confirm(Request $request)
    // {
    //     // 予約情報をリクエストから取得
    //     $reservation = $request->only(['check_in_date', 'check_out_date', 'guest_count']);
    //     // 予約対象の旅館情報を取得
    //     $post = Post::findOrFail($request->post_id); 
    //     return view('reservations.confirm', compact('reservation', 'post'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 投稿内容保存処理
        $reservation = Reservation::create([
            'user_id' => Auth::id(),   // ログインユーザーのIDを保存
            'post_id' => (int) $request->post_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guest_count' => $request->guest_count,
        ]);

        return redirect()->route('posts.index')->with('success', '予約が完了しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // findOrFailで該当の予約を取得
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
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
        // フォームから送信されたデータを受け取り、findOrFailで該当の予約を取得
        // updateメソッドで特定のカラムを更新
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->only(['check_in_date', 'check_out_date', 'guest_count']));

        return redirect()->route('mypage.index')->with('success', '予約情報を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // findOrFailで該当の予約を取得
        // deleteメソッドでデータを削除
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('mypage.index')->with('success', '予約をキャンセルしました！');
    }
}
