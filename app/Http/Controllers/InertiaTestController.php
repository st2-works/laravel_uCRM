<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\InertiaTest;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('Inertia/Index', [
            'blogs' => InertiaTest::all() //モデルの全データを取得
        ]);
    }

    public function create()
    {
        return Inertia::render('Inertia/Create');//resources/js/Pages/Inertia/Create.vueを読み込む
    }


    public function show($id)
    {
        //dd($id);
        return Inertia::render('Inertia/Show', [
            'id' => $id,
            'blog' => InertiaTest::findOrFail($id) //モデルの全データを取得
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([ //バリデーション
            'title' => ['required', 'max:255'], //必須、最大文字数255
            'content' => ['required'], //必須
        ]);

        $inertiaTest = new InertiaTest; //読み込んだモデルのインスタンス化
        $inertiaTest->title = $request->title; //モデルのカラムに値を代入
        $inertiaTest->content = $request->content; //モデルのカラムに値を代入
        $inertiaTest->save(); //保存

        return to_route('inertia.index')//保存後にindexにリダイレクト to_routeはLaravel9からのメソッド
        ->with([
            'message' => '登録しました'
        ]);
    }

    public function delete($id)
    {
        $book = InertiaTest::findOrFail($id);
        $book->delete();

        return to_route('inertia.index')
        ->with([
            'message' => '  削除しました'
        ]);

    }
}
