<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::latest();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-2">';
                    $btn .= '<button data-id="'.$row->id.'" class="btn btn-sm btn-primary btn-view"><i class="bi bi-eye"></i></button>';
                    $btn .= '<button data-id="'.$row->id.'" class="btn btn-sm btn-info btn-edit"><i class="bi bi-pencil"></i></button>';
                    $btn .= '<button data-id="'.$row->id.'" class="btn btn-sm btn-danger btn-delete"><i class="bi bi-trash"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->addColumn('harga_formatted', function ($row) {
                    return 'Rp ' . number_format($row->harga, 0, ',', '.');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.index');
    }


    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $product = Product::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ]);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $product = Product::findOrFail($id);
        $product->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil diperbarui',
            'data' => $product
        ]);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
