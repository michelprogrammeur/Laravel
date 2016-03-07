<?php

namespace App\Http\Controllers;

use Storage;
use App\Tag;
use App\Product;
use App\Picture;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Requests\ProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('tags', 'picture', 'category')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('title', 'id');
        $tags = Tag::lists('name', 'id');

        return view('admin.product.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        /*$this->validate($request, [
            'title'       =>'required',
            'slug'        =>'string|max:100',
            'price'       =>'required|numeric',
            'quantity'    =>'required|integer',
            'abstract'    =>'string|max:100',
            'category_id' =>'string',
            'status'      =>'in:published,unpublished',
        ]);*/

        $product = Product::create($request->all());  // hydratation de l'objet => inserer les données

        $im = $request->file('picture');
        if(!empty($im))
        {
            $ext = $im->getClientOriginalExtension();
            $uri = str_random(12).'.'.$ext;

            $picture = Picture::create([
                'uri' => $uri,
                'product_id' => $product->id,
            ]);
            $im->move('./uploads', $uri);
        }

        if(!empty($request->input('tag_id'))) {
            $product->tags()->attach($request->input('tag_id'));
        }

        return redirect('product')->with(['message'=>'']);

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
        $product = Product::find($id);
        $categories = Category::lists('title', 'id');
        $tags = Tag::lists('name', 'id');

        return view('admin.product.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        //$tags = (empty($request->input('tag_id')))? [] : $request->input('tag_id');
        $tags = $request->input('tag_id');
        if(empty($tags)) {
            $tags = [];
        }
        $product->tags()->sync($tags);


        /* image */ 
        // si lon coche juste la checkbox et qu'on ne remet pas d'autre image
        if($request->input('deletePicture') == 'true') {
            $deletePicture = $this->deletePicture($product);
        }

        // si on remplace l'image
        $im = $request->file('picture');
        if(!empty($im)) {

            if(!empty($deletePicture)) {
                $this->deletePicture($product);
            }

            $this->upload($im, $product->id);

            
        }
        return redirect('product')->with(['message'=> "Produit modifié"]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // todo 
        $p = Product::find($id);
        if (!is_null($p->picture)) {
            Storage::delete($p->picture->uri); // file
            $p->picture->delete();  // database
        }
        $p->delete();

        // todo translate label admin
        return back()->with(['message'=>trans('app.success')]);
    }


    /**
     * @refactoring method delete picture file and database.
     *
     */
    private function deletePicture(Product $product) {

        if(!is_null($product->picture)) {

            $fileName = $product->picture->uri;

            if(Storage::exists($fileName)) {
                Storage::delete($fileName);
            }

            $product->picture->delete();

            return true;
        }

        return false;
    }


    private function upload($im, $productId) {

        $ext = $im->getClientOriginalExtension();
        $uri = str_random(12).'.'.$ext;

        Picture::create([
            'uri'        =>$uri,
            'product_id' =>$productId
        ]);

        $im->move('uploads', $uri);
    }
}
