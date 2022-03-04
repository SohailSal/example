<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        // $data = Category::all();

 //       $data = Category::whereNull('parent_id')->get();
        // $arr = collect();
        // foreach ($data as $item) {
        //     $arr->push([
        //         'id' => $item->id,
        //         'name' => $item->name,
        //         'parent_id' => $item->parent_id,
        //         'children' => Category::where('parent_id',$item->id)->get()->map(function($sub){
        //             return[
        //                 'id' => $sub->id,
        //                 'name' => $sub->name,
        //             ];
        //         }),
        //     ]);
        // }
//dd($arr);

        // $data = Category::whereNull('parent_id')->get()->map(function($sub){
        //             return[
        //                 'id' => $sub->id,
        //                 'name' => $sub->name,
        //                 'parent_id' => $sub->parent_id,
        //             ];
        //         })->
        // toArray();

        // for($i=0;$i<count($data);$i++){
        //     print_r($data[$i]);
        //     echo "<br>";
        // }

        //        dd($arr);
 //    $data = $arr;
//        dd($data);

        $data = Category::tree()->get()->toTree();
        $data = $data->map(function($value){
            return [
                'id' => $value->id,
                'name' => $value->name,
                'children' => $value->children,
            ];
        });
//        dd($data);
        return Inertia::render('Categories/Index', ['data' => $data->toArray()]);
    }

    public function create()
    {
        $data = Category::tree()->get()->toTree();
        return Inertia::render('Categories/Create', ['data' => $data]);
    }

    public function store()
    {
        Category::create(
            Request::validate([
            'name' => ['required'],
            'parent_id' => [],
            ])
        );
        return Redirect::route('categories')->with('success', 'Category created.');
    }

}