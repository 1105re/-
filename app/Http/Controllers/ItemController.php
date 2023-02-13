<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = item::query('items.status', 'active');

        if(!empty($keyword)) {
            $query->where('name', 'LIKE', '%'. $keyword .'%')
                ->orWhere('type', 'LIKE', '%'. $keyword .'%')
                ->orWhere('detail', 'LIKE', '%'. $keyword .'%');
        }
        $items = $query
        ->get();
        
        $reccount = 0;
        if(empty($keyword) && count($items) == 0)
        {}
        
        elseif(!empty($keyword) && count($items) == 0){
            if(count(item::limit(1)->get()) >0 ){$reccount = 1;}
            else{$reccount = 0;}
            } 
        
        else{$reccount = 1;}

        return view('item.index', compact('reccount','items', 'keyword')); 
    }


    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
    /**
     * 商品編集画面
     */
    public function edit($id)
    {
        $iteminfo = item::find($id);
        $items = item::get();
         return view('item.edit',[
            'items' =>$items
        ])->with('item',$iteminfo);
    }
        /**
         * 商品編集
         */
            public function update(Request $request,$id)
        {
            $Itemdata = Item::find($id);
        
            $Itemdata->update([
               'name' => $request->name,
               'type' => $request->type,
               'detail' =>$request->detail,
            ]);

            $Itemdata->save();

            return redirect('/items');
        }   

        /**
         * 商品削除
         */
            public function destroy($id)
        {
            $Item = Item::find($id);
        
            $Item->delete();
            return redirect('/items');
        }
}
