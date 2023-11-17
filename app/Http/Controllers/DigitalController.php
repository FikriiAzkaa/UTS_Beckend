<?php

namespace App\Http\Controllers;

use App\Models\Digital;
use App\Models\News;
use Illuminate\Http\Request;

class DigitalController extends Controller
{
    public function index(){
        $digital = News::all();
  
        // jika data kosong maka kirim status code 204
        if($digital->isEmpty()){
          $data = [
            "message"=> 'Resource is empty',
          ];
  
          return response()->json($data, 204);  
  
        }
        
        $data = [
          'message' => 'Get All Digital media',
          'data'=> $digital
        ];
  
        return response()->json($data, 200);
      }
  
      // membuat function store
      public function store(Request $request){
          // validasi data request
          $request->validate([
            "title"=>"required",
            "author"=> "required",
            "description"=> "required",
            "content" => "required",
            "url" => "required",
            "url_image" => "required",
            "published_at" => "required",
            "category" => "required",
          ]);
          // menangkap data request
          $input = [
              'title' => $request->title,
              'author' => $request->author,
              'description' => $request->description,
              'content' => $request->content,
              'url' => $request->url,
              'url_image' => $request->url_image,
              'published_at' => $request->published_at,
              'category' => $request->publish
          ];
  
          // menggunakan model digital untuk insert data
          $digital = News::create($input);
          
          $data = [
              'message' =>'digital is Created Succesfully',
              'data'=> $digital,
          ];
  
          // mengembalikan data (json) dan kode 201
          return response()->json($data, 201);
      }
  
      // membuat function update
      public function update(Request $request,$id){
        // mencari data yang ingin di update
        $digital = News::find($id);
  
        // jika data yang dicari tidak ada, kirim kode 404
        if(!$digital){
          $data = [
            'message' => 'Data not Found'
          ];
  
          return response()->json($data, 404);
        }
  
        // menangkap data request 
        $digital->update([
            'title'=> $request->title ?? $digital->title,
            'author'=> $request->author ?? $digital->author,
            'description'=> $request->description ?? $digital->description,
            'content'=> $request->content ?? $digital->content,
            'url'=> $request->url ?? $digital->url,
            'url_image'=> $request->url_image ?? $digital->url_image,
            'published_at'=> $request->published_at ?? $digital->published_at,
            'category'=> $request->category ?? $digital->category,
          ]);
  
          // mengupdate nilai digital berdasarkan id
          $data = [
            'message'=> 'Digital updated successfully',
            'data'=> $digital
          ];
          
          // mengembalikan data 
          return response()->json($data, 200);
        
      }
      // membuat function delete
      public function destroy($id){
        // cari id digital yang ingin dihapus
        $digital = News::find($id);
  
        // jika data yang dicari tidak ada kirim kode 404
        if(!$digital){
          $data = [
            'message' => 'Data not Found'
          ];
  
          return response()->json($data, 404);
        }
        
        // hapus digital
        $digital->delete();
  
        $data = [
          'message'=> 'Digital deleted succesfully',
          'data'=> $digital
        ];
  
        // mengembalikan data kode 200
        return response()->json($data, 200);
    
    }
  
    // membuat detail digital
    public function show ($id){
      # cari id digital yang ingin didapatkan
      $digital = News::find($id);
  
      if($digital){
        $data = [
          'message' => 'Get detail digital',
          'data' => $digital
        ];
  
        // mengembalikan data
        return response()->json($data, 200);
      }else{
        $data = [
          'message' => 'Digital not Found',
        ];
  
        // mengembalikan data
        return response()->json($data, 404);
      }
    }
}
