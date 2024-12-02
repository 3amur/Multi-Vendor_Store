<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
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
        $request = request();
        $query = Category::query();
        // search Data
        if($name = $request->query('name')){
            $query->where('name', 'LIKE', "%{$name}%");
        }
        if($status = $request->query('status')){
            $query->where('status', '=', $status);
        }
        $categories = $query->paginate(2); // return collection object 
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
    public function store(CategoryRequest $request)
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
       
        // make custom validation with messages 
        // $request->validate(Category::rules(),[
        //     // to make custom validation messages
        //     'name.required' => 'filed :attribute is required',
        //     'unique' => 'filed :attribute exists',
        // ]);
        
        // merge slug to request [key => value]
        $request->merge(['slug' => Str::slug($request->post('name'))]);
        $data = $request->except('image');
        $newImage = $this->uploadImage($request,'image');
        $data['image'] = $newImage;
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
            if (!$category){
                return redirect()->back();
            }
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
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $oldImage = $category->image;
        $request->merge(['slug' => Str::slug($request->post('name'))]); 

        $data = $request->except('image');
        $newImage = $this->uploadImage($request, 'image');
        if($newImage){
            $data['image'] = $newImage;
        }
        $category->update($data);
        
        if($request->file('image') && $oldImage){
            Storage::disk('public')->delete($oldImage);
        }
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
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('categories.index')->with('danger', 'Category Deleted Successfully!');
    }

    protected function uploadImage(Request $request, $fileName){
        if($request->hasFile($fileName)){
            $file = $request->file($fileName); // uploadedFile Object
            $path = $file->store('categories', 'public');
            return $path;
        }
        return null;
    }
}
