<?php

namespace App\Http\Controllers;
use App\Models\Buku;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
     public function index() {

    $books = Buku::query()->latest()->get();
    // $artikels = $query->paginate(10);

    if ($books->isEmpty()) {
        return response()->json([
            'status'=> Response::HTTP_NOT_FOUND,
            'massage'=>'artikel empty'
        ],Response::HTTP_NOT_FOUND);
        }else {
            return response()->json([
                'data'=> $books->map(function($book){
                    return [
                        'id' => $book->id,
                        'title' => $book->title,
                        'author' => $book->author,
                        'page' => $book->page,
                        'category' => $book->Category->category,
                        'publish_date' => $book->publish_date
                        ];
                    }),

                    'status'=> Response::HTTP_OK,
                    'message'=>'list buku'
                    ]);

                }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'author' => 'required',
            'page' => 'required',
            'category_id' => 'required',
            'publish_date' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else{
            Buku::create([
                'title' => $request->title,
                'author' => $request->author,
                'page' => $request->page,
                'category_id' => $request->category_id,
                'publish_date' => $request->publish_date
            ]);

            return response()->json([
                'status' => Response::HTTP_OK, 'message' => 'data masuk db'
            ],Response::HTTP_OK);
        }
    }

    public function show($id)//24-nevid
    {
        //$Artikel = Artikel::where('id', $id)->first(); //-> ngambil data sesuai id

        $book = Buku::find($id); //-> ngambil data sesuai id

        if ($book) {                     //jika data ada  muncul kan datanya sesuai isi if
            return response()->json([
                'status' => Response::HTTP_OK,
                'data' => [
                'title' => $book->title,
                'author' => $book->author,
                'page' => $book->page,
                'category' => $book->Category->name,
                'publish_date' => $book->publish_date
                ]
            ], Response::HTTP_OK);
        } else {
            //jika tidak berarti tampilkan else (not found)
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Artikel not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id)//24-nevid
    {
        $book = Buku::find($id);

        if (!$book) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Artikel not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'page' => 'required',
            'category_id' => 'required',
            'publish_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }else {
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'page' => $request->page,
                'category_id' => $request->category_id,
                'publish_date' => $request->publish_date
            ]);

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Data updated'
            ], Response::HTTP_OK);
        }

    }

    public function destroy($id){//24-nevid

        $book = Buku::find($id);

        $book->delete();
            return response()->json([
                'status'=> Response::HTTP_OK,
                'massage'=>'artikel dihapus'
            ],Response::HTTP_OK);
    }
}
