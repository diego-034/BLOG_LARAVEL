<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Repositories\IRepository\IModelRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private IModelRepository $IModelRepository;
    private Comment $Comment;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Comment = new Comment();
        $this->middleware('auth');
    }

    public function List(Request $params)
    {
        try {
            $data['Model'] = $this->Comment;
            $response = $this->IModelRepository->List($data);
            if (isset($response['Error'])) {
                return $this->SendError("Error", $response['Error']->getMessage(), 422);
            }
            return $this->SendResponse($response['OK'], "List OK");
        } catch (Exception $ex) {
            return $this->SendError("Error", $ex->getMessage(), 422);
        }
    }

    public function Insert(Request $params)
    {
        try {
            $response = Validator::make($params->all(), [
                'comment' => 'required|string',
                'post_id' => 'required'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $data = $params->all();
            $data['user_id'] = Auth::id();
            $data['Model'] = $this->Comment;
            $response = $this->IModelRepository->Insert($data);

            if (isset($response['Error'])) {
                throw new Exception('Error');
            }
            return Redirect::action('PostController@Find', $data['post_id']);
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
                'comment' => 'required|string'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $this->authorize('update_delete', Comment::find($id));

            $data = array();
            $data['Entity']['id'] = $id;
            $data['Entity']['comment'] = $params->get('comment');
            $data['Model'] = $this->Comment;
            $response = $this->IModelRepository->Update($data);
            if (isset($response['Error'])) {
                throw new Exception('Error');
            }
            return Redirect::action('PostController@Find',  $params->get('post_id'));
        } catch (Exception $ex) {
            return view('error');
        }
    }

    public function Delete(Request $params)
    {
        try {
            $response = Validator::make($params->all(), [
                'comment_id' => 'required|numeric'
            ]);
            if ($response->fails()) {
                throw new Exception('Error');
            }
    
            $this->authorize('update_delete', Comment::find($params->get('comment_id')));
            $data = array();
            $data['id'] = $params->get('comment_id');
            $data['Model'] = $this->Comment;
            $response = $this->IModelRepository->Delete($data);

            if ($response['OK'] == ['Not found']) {
                throw new Exception('Error');
            }
            if (isset($response['Error'])) {
                throw new Exception('Error');
            }
            return Redirect::action('PostController@Find', $params->get('post_id'));
        } catch (Exception $ex) {
            return view('error')->with("ex",$ex);
        }
    }

    public function Find($id)
    {
        try {
            if ($id == null) {
                throw new Exception('Error');
            }
            $data = array();
            $data['id'] = $id;
            $data['Model'] = $this->Comment;
            $response = $this->IModelRepository->Find($data);

            if ($response['OK'] == ['Not found']) {
                throw new Exception('Error');
            }
            if (isset($response['Error'])) {
                throw new Exception('Error');
            }
            return Redirect::route('home');
        } catch (Exception $ex) {
            return view('error');
        }
    }
}
