<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Book::with('bookCategory');

            return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('coverImg', function ($data) {
                // memanggil file di pblic dengan asset()
                return '
                    <img src="' . asset($data->cover) . '" width="100" class="d-block mx-auto">';
            })
            ->editColumn('price', function ($data) {
                return 'Rp ' . number_format($data->price, 0, ',', '.');
            })
            ->addColumn('category_name', function($data) {
                // mengambil nama kategori dari relasi book_category_id
                return $data->bookCategory ? $data->bookCategory->name : '';
            })
            ->addColumn('action', function($data) {
                $btnDetail = '
                    <button type="button" class="btn btn-sm btn-info" id="btn-detail"
                    data-cover="' . asset($data->cover) . '"
                    data-title="' . htmlspecialchars($data->title, ENT_QUOTES, 'UTF-8') . '"
                    data-category="' . htmlspecialchars($data->bookCategory->name ?? '-', ENT_QUOTES, 'UTF-8') . '"
                    data-price="Rp ' . number_format($data->price, 0, ',', '.') . '"
                    data-writer="' . htmlspecialchars($data->writer, ENT_QUOTES, 'UTF-8') . '"
                    data-publisher="' . htmlspecialchars($data->publisher, ENT_QUOTES, 'UTF-8') . '"
                    data-language="' . htmlspecialchars($data->language, ENT_QUOTES, 'UTF-8') . '"
                    data-release="' . date('d M Y', strtotime($data->release_date)) . '"
                    data-pages="' . $data->page_of_book . '"
                    data-description="' . htmlspecialchars($data->description ?? '', ENT_QUOTES, 'UTF-8') . '"   > 
                        Detail </button>
                    ';
                    $btnEdit = '<a href="'.route('admin.books.edit', $data->id).'" class="btn btn-sm btn-warning">Edit</a>';
                    $btnDelete = '<form method="POST" action="'.route('admin.books.destroy', $data->id).'">'.
                    csrf_field().method_field('DELETE').'<button type="submit" class="btn btn-sm btn-danger">Hapus</button>'.'</form>';

                    return '<div class="d-flex gap-2">'. $btnDetail . $btnEdit. $btnDelete. '</div>';
                })
                ->rawColumns(['coverImg', 'action'])
                ->toJson();

        }
        return view('admin.books.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookCategory = BookCategory::all();
        return view('admin.books.create', compact('bookCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            // mimes : menentukan jenis file yang boleh di upload
            'cover' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'title' => ['required', 'string', 'min:3'],
            'writer' => ['required', 'string', 'min:3'],
            'publisher' => ['required', 'string', 'min:3'],
            'price' => ['required', 'numeric'],
            'release_date' => ['required', 'date'],
            'page_of_book' => ['required', 'numeric'],
            'language' => ['required'],
            // exist (memastikan data id ada di table book_categories)
            'book_category_id' => ['required', 'exists:book_categories,id'],
            'description' => ['nullable'] //boleh kosong
        ]);

        if ($request->file('cover')) {
            $cover = $request->file('cover');      // ambil file gambar
            // rename nama gambar
            $name = time() . "-" . $cover->getClientOriginalName();
            // simpan gambar ke folder storage/app/public
            // putFileAs('nama_fplder', 'filenya', 'nama_file')
            Storage::disk('public')->putFileAs('covers', $cover, $name);
            // simpan alamat penyimpanan gambar ke data validasi di atas untuk dikirim ke db
            $validateData['cover'] = Storage::url('covers/' . $name);
        }
        // simpan ke data ke database
        Book::create($validateData);
        return redirect()->route('admin.books.index')->with('success', 'Berhasil membuat data Buku!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $bookCategory = BookCategory::all();
        return view('admin.books.edit', compact('book', 'bookCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validateData = $request->validate([
            // mimes : menentukan jenis file yang boleh di upload
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'title' => ['required', 'string', 'min:3'],
            'writer' => ['required', 'string', 'min:3'],
            'publisher' => ['required', 'string', 'min:3'],
            'price' => ['required', 'numeric'],
            'release_date' => ['required', 'date'],
            'page_of_book' => ['required', 'numeric'],
            'language' => ['required'],
            // exist (memastikan data id ada di table book_categories)
            'book_category_id' => ['required', 'exists:book_categories,id'],
            'description' => ['nullable'] //boleh kosong
        ]);

        // Handle file upload jika ada gambar sampul baru yang diunggah
        if($request->hasFile('cover')) {
            // 1 hapus cover lama dari storage  jika ada
            if ($book->cover) {
                // ambil nama file asli dari URL (contoh: "/storage/covers/123_file.jpg" -> "covers/123_file.jpg")
                $oldCoverPath = str_replace('/storage/', '', $book->cover);

                if(Storage::disk('public')->exists($oldCoverPath)) {
                    Storage::disk('public')->delete($oldCoverPath);
                }
            }

            // 2 simpan cover baru
            $coverImage = $request->file('cover');
            $coverImageName = time() . '_' . $coverImage->getClientOriginalName();

            Storage::disk('public')->putFileAs('covers', $coverImage, $coverImageName);

            // 3 set path URL cover baru  ke array data yang divalidasi
            $validateData['cover'] = Storage::url('covers/', $coverImageName) ;
        }
        
        // Update data buku
        $book->update($validateData);

        return redirect()->route('admin.books.index')->with('success', 'Berhasil memperbarui data buku.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover) {
            $oldImagePath = str_replace('/storage/', '', $book->cover);

            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Berhasil menghapus data buku.');
    }
}
