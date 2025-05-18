<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
     public function index() {

    $categories = Category::query()->latest()->get();


    if ($categories->isEmpty()) {
        return response()->json([
            'status'=> Response::HTTP_NOT_FOUND,
            'massage'=>'category empty'
        ],Response::HTTP_NOT_FOUND);
        }else {
            return response()->json([
                'data'=> $categories->map(function($category){
                    return [
                        'id' => $category->id,
                        'category' => $category->category,
                        ];
                    }),

                    'status'=> Response::HTTP_OK,
                    'message'=>'list category'
                    ]);

                }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'category' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else{
            Category::create([
                'category' => $request->category,
            ]);

            return response()->json([
                'status' => Response::HTTP_OK, 'message' => 'data masuk db'
            ],Response::HTTP_OK);
        }
    }

    public function show($id)//24-nevid
    {

        $category = Category::find($id); //-> ngambil data sesuai id

        if ($category) {                     //jika data ada  muncul kan datanya sesuai isi if
            return response()->json([
                'status' => Response::HTTP_OK,
                'data' => [
                'category' => $category->category,
                ]
            ], Response::HTTP_OK);
        } else {
            //jika tidak berarti tampilkan else (not found)
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'category not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id)//24-nevid
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'category not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }else {
            $category->update([
                'category' => $request->category,
            ]);

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Data updated'
            ], Response::HTTP_OK);
        }

    }

    public function destroy($id){//24-nevid

        $category = Category::find($id);

        $category->delete();
            return response()->json([
                'status'=> Response::HTTP_OK,
                'massage'=>'category dihapus'
            ],Response::HTTP_OK);
    }
}
