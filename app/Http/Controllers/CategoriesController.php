<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Categories";
        $categories = Category::paginate(10);
        return view('categories.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Category";
        return view('categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'picture' => 'image|max:2048'
        ]);
        $data = $request->only('name');
        if ($file = $request->file('picture')) {
            $filename = strtolower(uniqid() . '.' . $file->getClientOriginalExtension());
            $dest = public_path('uploads/categories');
            $file->move($dest, $filename);
            $data['picture'] = $filename;
        }
        Category::create($data);
        return redirect()->route('categories.index');

        /*
        $this->validate($request, [
            'name' => 'required|min:4|unique:categories,name'
        ], [
            'name.required' => 'Ce champs est requis'
        ]);
        */
        /*$category = new Category(['name' => $request->name]);
        //$category = new Category($request->only(['name']));
        $category->save();*/
        //Category::create(['name' => $request->name]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category) return redirect()->route('categories.index');
        $title = "Edit Category";
        return view('categories.edit', compact('title', 'category'));
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
        /*
        $this->validate($request, [
            'name' => 'required|min:4|unique:categories,name,'.$id
        ], [
            'name.required' => 'Ce champs est requis'
        ]);
        if($category = Category::find($id)){
            $category->update(['name' => $request->name]);
        }
        //Category::where('id', $id)->update([]);
        return redirect()->route('categories.index');
        */


        $this->validate($request, [
            'name' => 'required',
            'picture' => 'image|max:2048'
        ]);
        $category = Category::find($id);
        if (!$category) return redirect()->route('categories.index');
        $data = $request->only('name');
        if ($file = $request->file('picture')) {
            $filename = strtolower(uniqid() . '.' . $file->getClientOriginalExtension());
            $dest = public_path('uploads/categories');
            $file->move($dest, $filename);
            $data['picture'] = $filename;
            $oldFile = public_path('uploads/categories').'/'.$category->picture;
            if(!empty($category->picture) && \File::exists($oldFile)){
                @unlink($oldFile);
            }
        }
        $category->update($data);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($category = Category::find($id)){
            $category->delete();
        }
        return redirect()->route('categories.index');
    }
}

