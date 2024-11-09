<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        /********** request Data includes **********/
        // $request->input('name'); // from input form
        // $request->post('name'); // from post method
        // $request->get('name'); // from (get & post) method 
        // $request->query('name'); // from query param url
        // $request->name; // name of input
        // $request['name'];
        // $request->all(); // return array of data
        // $request->only(['name', 'status']); // only include that input names
        // $request->except(['name','status']); // without that names

        // merge slug to request [key => value]
        $request->merge(['slug' => Str::slug($request->post('name'))]);
        $data = $request->except('image');
        if($request->hasFile('image')){
            $file = $request->file('image'); // uploadedFile Object
            $path = $file->store('categories', 'public');
            $data['image'] = $path;
        }
        Category::create($data);
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
        abort(404);
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
            // select * categories where id != $id & (parent_id != $id or perent_id is Null)
            $parents = Category::where('id', '<>', $id)
                ->where(function ($query) use ($id) {
                    $query->whereNull('parent_id')
                        ->orWhere('parent_id', '<>', $id);
                    })->get();  
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
        $oldImage = $category->image;
        $request->merge(['slug' => Str::slug($request->post('name'))]); 

        $data = $request->except('image');
        if($request->hasFile('image')){
            Storage::disk('public')->delete($oldImage);
            $file = $request->file('image'); // uploadedFile Object
            $path = $file->store('categories', 'public');
            $data['image'] = $path;
        }
        $category->update($data);
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
        $category = Category::findOrFail($category);
        $category->delete($category);

        Storage::disk('public')->delete($category->image);
        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully!');
    }
}
