<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Storage\StorageClient;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Book::with('category')->get();
        $categories = Category::all();

        $paginate = Book::orderBy('id', 'asc')->paginate(8);
        return view('landingpage', ['books' => $paginate, 'categories' => $categories]);
    }

    public function tampil()
    {
        $buku = Book::with('category')->get();
        $categories = Category::all();
        return view('admin.kelolabuku', ['books' => $buku, 'title' => 'KelolaBuku', 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('cover_photo')) {
            $image = $request->file('cover_photo')->store('book_cover', 'public');
            $googleConfigFile = file_get_contents(config_path('googlecloud.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('googlecloud.storage_bucket');
            $bucket = $storage->bucket($storageBucketName);

            $filenameWithExt = $request->file('cover_photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('cover_photo')->storeAs('public/images/cover', $filenameSimpan);
            $savepath = 'public/images/cover/' . $filenameSimpan;


            // save on bucket
            $fileSource = fopen(storage_path('app/public/' . $savepath), 'r');

            $bucket->upload($fileSource, [
                'predefinedAcl' => 'publicRead',
                'name' => $savepath
            ]);
        }

        $title = $request->title;
        $slug = str::slug($title, '-');

        Book::create([
            'category_id' => $request->category_id,
            'cover_photo' => $image,
            'isbn' => $request->isbn,
            'title' => $request->title,
            'slug' => $slug,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('kelolabuku.tampil')
            ->with('success', 'buku berhasil ditambahkan');
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
        //
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
        $book = Book::find($id);

        $title = $request->title;
        $slug = str::slug($title, '-');

        $book->category_id = $request->category_id;
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->slug = $slug;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->price = $request->price;
        $book->stock = $request->stock;

        if ($request->file('cover_photo')) {
            if ($book->cover_photo && file_exists(storage_path('app/public/' . $book->cover_photo))) {
                Storage::delete('public/' . $book->cover_photo);
            }
            $image = $request->file('cover_photo')->store('book_cover', 'public');
        } else {
            $image = $book->cover_photo;
        }




        $book->cover_photo = $image;

        $book->save();
        return redirect()->route('kelolabuku.tampil')
            ->with('success', 'buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Book::find($id);

        if ($buku->cover_photo && file_exists(storage_path('app/public/' . $buku->cover_photo))) {
            Storage::delete('public/' . $buku->cover_photo);
            $image = $buku->cover_photo;
            $googleConfigFile = file_get_contents(config_path('googlecloud.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('googlecloud.storage_bucket');
            $bucket = $storage->bucket($storageBucketName);
            $object = $bucket->object($image);

            $object->delete();
        }

        $buku->delete();
        return redirect()->route('kelolabuku.tampil')
            ->with('success', 'buku berhasil dihapus');
    }
}
