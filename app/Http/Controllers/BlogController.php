<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\BlogNavRepositoryInterface;
  
use App\Models\User;  

class BlogController extends Controller
{
    private $blogRepository;

    public function __construct(BlogNavRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }
    
    
    public function index(){
        
        $blogs = $this->blogRepository->paginate(10); 
        
        return view('blog.index',compact('blogs'));
    }

    public function show(Request $request, $id){ 
        
        $info = $this->blogRepository->find($id); 
        $info = $info[0];
        return view('blog.show',compact('info'));
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}
