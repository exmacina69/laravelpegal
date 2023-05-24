<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;

class ProductController extends Controller
{
        
    public function get_popular_products(Request $request){
  
        $list = Food::where('type_id', 2)->take(10)->get();
        
                foreach ($list as $item){
                    $item['description']=strip_tags($item['description']);
                    $item['description']=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']); 
                    unset($item['selected_people']);
                    unset($item['people']);
                }
                
                 $data =  [
                    'total_size' => $list->count(),
                    'type_id' => 2,
                    'offset' => 0,
                    'products' => $list
                ];
                
         return response()->json($data, 200);
 
    }
            public function uploadFiles(Request $request){
                $this->validate($request, [
                    'file' => 'required',
                    // 'keterangan' => 'required',
                ]);
         
                // menyimpan data file yang diupload ke variabel $file
                $file = $request->file('file');
         
                          // nama file
                echo 'File Name: '.$file->getClientOriginalName();
                echo '<br>';
         
                          // ekstensi file
                echo 'File Extension: '.$file->getClientOriginalExtension();
                echo '<br>';
         
                          // real path
                echo 'File Real Path: '.$file->getRealPath();
                echo '<br>';
         
                          // ukuran file
                echo 'File Size: '.$file->getSize();
                echo '<br>';
         
                          // tipe mime
                echo 'File Mime Type: '.$file->getMimeType();
         
                          // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'data_file';
         
                        // upload file
                $file->move($tujuan_upload,$file->getClientOriginalName());
                
            }
        public function get_recommended_products(Request $request){
        $list = Food::where('type_id', 3)->take(10)->get();
        
                foreach ($list as $item){
                    $item['description']=strip_tags($item['description']);
                    $item['description']=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']); 
                    unset($item['selected_people']);
                    unset($item['people']);
                }
                
                 $data =  [
                    'total_size' => $list->count(),
                    'type_id' => 3,
                    'offset' => 0,
                    'products' => $list
                ];
                
         return response()->json($data, 200);
    }
    

       public function test_get_recommended_products(Request $request){
  
        $list = Food::skip(5)->take(2)->get();
      
        foreach ($list as $item){
            $item['description']=strip_tags($item['description']);
            $item['description']=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']); 
        }
        
         $data =  [
            'total_size' => $list->count(),
            'limit' => 5,
            'offset' => 0,
            'products' => $list
        ];
         return response()->json($data, 200);
        // return json_decode($list);
    }

}
