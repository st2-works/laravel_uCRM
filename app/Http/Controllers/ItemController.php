<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //一覧画面を表示
        return Inertia::render('Items/Index', [
        'items' => Item::select('id', 'name', 'price','is_selling')
        ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //登録画面を表示
        return Inertia::render('Items/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        //データを登録
        Item::create([
            'name' => $request->name,
            'memo' => $request->memo,
            'price' => $request->price,
        ]);

        //登録後に一覧ページにリダイレクト
        return to_route('items.index')
        //登録後にフラッシュメッセージを表示
        ->with([
            'message' => '登録しました。',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // itemモデルの全データを取得
        return Inertia::render('Items/Show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        // itemモデルの全データを取得
        return Inertia::render('Items/Edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->name = $request->name;
        $item->memo = $request->memo;
        $item->price = $request->price;
        $item->is_selling = $request->is_selling;
        $item->save();

        return to_route('items.index')
        ->with([
            'message' => '更新しました。',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        //削除後に一覧ページにリダイレクト
        return to_route('items.index')
        //削除後にフラッシュメッセージを表示
        ->with([
            'message' => '削除しました。',
            'status' => 'danger'
        ]);

    }
}
