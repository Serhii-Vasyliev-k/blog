<?php

namespace App\Http\Controllers;

use App\Services\PostServiceInterface;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getFeaturedPosts();

        $allPosts = $this->postService->getPosts(1);
        $bigFeaturedPosts = null;
        $featuredPosts = [];
        foreach ($posts as $key => $post) {
            if ($key === 0) {
                $bigFeaturedPosts = $post;
            } else {
                $featuredPosts['normal'][] = $post;
            }
        }
        return view('home.index', compact('allPosts', 'featuredPosts', 'bigFeaturedPosts'));
    }

    public function styles()
    {
        return view('home.styles');
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }
}
