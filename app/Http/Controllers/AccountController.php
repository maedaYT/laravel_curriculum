<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $account = User::findOrFail($id);
        return view('accounts.edit', compact('account'));
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
        // アカウント編集画面からPUTメソッドで送信されたデータを受け取り、findOrFailで該当のユーザー情報を取得
        // updateメソッドで特定のカラムを更新
        $account = User::findOrFail($id);
        $account->update($request->only(['name', 'email', 'image']));

        return redirect()->route('mypage.index')->with('success', 'アカウント情報を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // アカウント削除画面からDELETEメソッドで送信されたデータを受け取り、findOrFailで該当のユーザー情報を取得
        // deleteメソッドでデータを削除
        $account = User::findOrFail($id);
        $account->delete();

        return redirect()->route('mypage.index')->with('success', '予約をキャンセルしました！');
    }

    public function delete($id)
    {
        // Userモデルを使用してアカウントを取得
        $account = User::findOrFail($id);

        return view('accounts.destroy', compact('account'));
    }
}
