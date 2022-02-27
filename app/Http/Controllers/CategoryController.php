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
        $data = Category::all();

 //       $data = Category::whereNull('parent_id')->get();
        $arr = collect();
        foreach ($data as $item) {
            $arr->push([
                'id' => $item->id,
                'name' => $item->name,
                'parent_id' => $item->parent_id,
                'children' => Category::where('parent_id',$item->id)->get()->map(function($sub){
                    return[
                        'id' => $sub->id,
                        'name' => $sub->name,
                    ];
                }),
            ]);
        }
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
     $data = $arr;
//        dd($data);


$categories = Category::tree()->get()->toTree();
$data = $categories;
//dd($categories);
        return Inertia::render('Categories/Index', ['data' => $data, 'categories' => $categories]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
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