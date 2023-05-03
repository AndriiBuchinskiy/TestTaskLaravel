<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Pusher\Pusher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $userModel, Post $postModel, Comment $commentModel)
    {
        $this->userModel = $userModel;
        $this->postModel = $postModel;
        $this->commentModel = $commentModel;
    }
    public function generatePdf()
    {
        $usersCount = $this->userModel->count();

        $postsByTag = $this->postModel->join('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->join('tags', 'post_tag.tag_id', '=', 'tags.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->selectRaw('users.name, tags.name as tag, count(*) as count')
            ->groupBy('users.name', 'tags.name')
            ->get();

        $postsByCategory = $this->postModel->join('users', 'posts.user_id', '=', 'users.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->selectRaw('users.name, categories.name as category, count(*) as count')
            ->groupBy('users.name', 'categories.name')
            ->get();

        $commentsCount = $this->commentModel->count();

        $commentsByUser = $this->commentModel->join('users', 'comments.user_id', '=', 'users.id')
            ->selectRaw('users.name, count(*) as count')
            ->groupBy('users.name')
            ->get();

        $data = [
            'usersCount' => $usersCount,
            'postsByTag' => $postsByTag,
            'postsByCategory' => $postsByCategory,
            'commentsCount' => $commentsCount,
            'commentsByUser' => $commentsByUser,
        ];

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf.report', $data);
        $pdfUrl = storage_path('app/public/report.pdf');
        $pdf->save($pdfUrl);

        $pusher = new Pusher('b851531fa3e27aa68997', 'c55be29a5e9c39ce8429', '1586682', [
            'cluster' => 'eu',
            'useTLS' => true
        ]);
        $pusher->trigger('mint-salute-672', 'pdf-ready', ['url' => asset('storage/report.pdf')]);

        return response()->json(['url' => asset('storage/report.pdf')]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
