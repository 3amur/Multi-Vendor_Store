<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("dashboard.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();
        return view("dashboard.categories.create_edit", compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->input('name'); // from input form
        $request->post('name'); // from post method
        $request->get('name'); // from (get & post) method 
        $request->query('name'); // from query param url
        $request->name; // name of input
        $request['name'];

        $request->all(); // return array of data
        $request->only(['name', 'status']); // only include that input names
        $request->except(['name','status']); // without that names
        // requuest merge slug
        $request->merge(['slug' => Str::slug($request->post('name'))]);

        Category::create($request->all());
        //PRG
        return redirect()->route('categories.index')->with('success', 'Category Added Successfully');
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
        try{
            $category = Category::find( $id);
            $parents = Category::where('id', '<>', $id)->get();
            return view('dashboard.categories.create_edit', compact('category', 'parents'));
        } catch (\Exception $e) {
            abort(404);
        }
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
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        // $category = Category::findOrFail($category);
        // $category->delete($category);
        
        Category::destroy($category);
        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully!');
    }
}
