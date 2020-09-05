<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;

use App\Remind;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\HTML;

use Validator;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        
        $category = Category::all()->sortByDesc('created_at');
        
        return $category;
        /*
           この場合$newsは返すだけで何もしていないので、
           return News::all()->sortByDesc('updated_at');　
           の方がスマート
        */
    }
    
    // public function create(Request $request)
    // {
    //     // json
    //     $name = $request->input('name');
        
    //     // // validation
    //     $validator = Validator::make($request->all(), Category::$rules);
        
    //     $category = new Category;
    //     $form = $request->all();
   
    //     // user_id(auth入れてないため)
    //     $category->user_id = 1;
    //     $category->name = $name;

        
    //     $category->fill($form);
    //     $category->save();
        
 
    //     if($validator->fails()){
    //       return response('1');
    //     }
    //     else{
    //       return response('0');
    //     }
       
    // }
    
    // // public function update(Request $request)
    // // {
    // //   // json取得
    // //     $category_form = [$request->input('id') , $request->input('name')];
        
    // //   //モデルから一致したidを取り出す 
    // //     // $category = Category::where('id' , $category_form[0])->get();
    // //     // $category->fill($category_form)->save();
        
    // //     Category::where('id', $category_form[0])->update(['name' => $category_form[1] ]);
        
    // //     return $category_form;
        
    // // }
    
    // // ※リマインド消去（カテゴリではない）
    // public function delete(Request $request)
    // {
    //     $remind_id = $request->input('id');
        
    //     $remind = Remind::where('id' , $remind_id)->first();
    //     $remind->delete();
    //     return $remind;
        
    // }
}
        
        
    
    
