<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Sns;
use App\User;

class SnsController extends Controller
{
    public function add()
    {
        return view('admin.sns.create');
    }

    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Sns::$rules);

        $sns = new Sns;
        $form = $request->all();

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        //user_idの取得
        $user = Auth::user();
        $user_id = Auth::id();
        $sns->user_id = $user_id;

        // データベースに保存する
        $sns->fill($form);
        $sns->save();

        // admin/sns/indexにリダイレクト
        return redirect('admin/sns/index');
    }

    public function index(Request $request)
    {
        $posts = Sns::orderBy('id', 'desc')->get();
        $user = new User;
        return view('admin.sns.index', ['posts' => $posts, 'user' => $user]);
    }

    public function delete(Request $request)
    {
        // 該当するSns Modelを取得
        $sns = Sns::find($request->id);
        if(Auth::id() === $sns->user_id){
            // 削除する
            $sns->delete();
        }
        return redirect('admin/sns/index');
    }
}
