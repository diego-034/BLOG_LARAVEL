<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Exception;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private IModelRepository $IModelRepository;
    private Post $Post;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Post = new Post();
        $this->middleware('auth');
    }

    public function List(Request $params)
    {
        try {
            $response['OK'] = DB::table('posts')
                ->join(
                    'users',
                    'posts.user_id',
                    '=',
                    'users.id'
                )->select([
                    'posts.post_title',
                    'posts.post_body',
                    'posts.id as post_id',
                    'users.name',
                    'users.id as user_id'
                ])
                ->orderBy('posts.id', 'desc')
                ->get();

            if ($response['OK'] == null) {
                throw new Exception('Error');
            }
            return view('home')->with('response', $response)->with('status', true);
        } catch (Exception $ex) {
            return view('error');
        }
    }

    public function Insert(Request $params)
    {
        try {
            $response = Validator::make($params->all(), [
                'post_title' => 'required|string',
                'post_body' => 'required|string'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }

            $data = $params->all();
            $data['user_id'] = Auth::id();
            $data['Model'] = $this->Post;
            $response = $this->IModelRepository->Insert($data);

            if (isset($response['Error'])) {
                throw new Exception('Error');
            }
            return Redirect::route('home');
        } catch (Exception $ex) {
            return view('error');
        }
    }

    public function Update(Request $params, $id)
    {
        try {
            if ($id == null) {
                throw new Exception('Error');
            }
            $response = Validator::make($params->all(), [
                'post_title' => 'required|string',
                'post_body' => 'required|string'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $this->authorize('update_delete', Post::find($id));
            $data = array();
            $data['Entity']['id'] = $id;
            $data['Entity']['post_title'] = $params->get('post_title');
            $data['Entity']['post_body'] = $params->get('post_body');
            $data['Model'] = $this->Post;
            $response = $this->IModelRepository->Update($data);
            if (isset($response['Error'])) {
                throw new Exception('Error');
            }
            return Redirect::route('posts', ['id' => Auth::id()]);
        } catch (Exception $ex) {
            return view('error');
        }
    }

    public function Delete(Request $params)
    {
        try {

            $response = Validator::make($params->all(), [
                'post_id' => 'required|numeric'
            ]);
            if ($response->fails()) {
                throw new Exception('Error');
            }
            $id =  $params->get('post_id');
            $this->authorize('update_delete', Post::find($id));
            $data = array();
            $data['id'] = $params->get('post_id');
            $response = DB::table('comments')->where('post_id', '=', $data['id'])->delete();

            $data['Model'] = $this->Post;
            $response = $this->IModelRepository->Delete($data);

            if ($response['OK'] == ['Not found']) {
                throw new Exception('Error');
            }
            if (isset($response['Error'])) {
                throw new Exception('Error');
            }
            return Redirect::route('posts', ['id' => Auth::id()]);
        } catch (Exception $ex) {
            return view('error');
        }
    }

    public function Find($id)
    {
        try {
            if ($id == null) {
                throw new Exception('Error');
            }
            $response['P'] = DB::table('posts')->join(
                'users',
                'posts.user_id',
                '=',
                'users.id'
            )->select([
                'users.name',
                'users.id as user_id',
                'posts.id as post_id',
                'posts.post_title',
                'posts.post_body'
            ])->where('posts.id', '=', $id)->get();

            $response['C'] = DB::table('comments')->join('users', 'comments.user_id', '=', 'users.id')
                ->select([
                    'comments.id as comment_id',
                    'comments.user_id',
                    'comments.comment',
                    'users.name',
                    'users.id as user_comment',

                ])->where('post_id', '=', $id)->get();

            if ($response['P'] == null) {
                throw new Exception('Error');
            }
            return view('post')->with('response', $response);
        } catch (Exception $ex) {
            return view('error');
        }
    }

    public function Consult($id)
    {
        try {
            if ($id != Auth::id()) {
                return Redirect::route('posts', ['id' => Auth::id()]);
            }
            $response['OK'] = DB::table('posts')
                ->join(
                    'users',
                    'posts.user_id',
                    '=',
                    'users.id'
                )->select([
                    'posts.post_title',
                    'posts.post_body',
                    'posts.id as post_id',
                    'users.name',
                    'users.id as user_id'
                ])->where('posts.user_id', '=', $id)
                ->orderBy('posts.id', 'desc')
                ->get();
            if (isset($response['Error'])) {
                throw new Exception('Error');
            }

            return view('home')->with('response', $response);
        } catch (Exception $ex) {
            return view('error');
        }
    }
}
