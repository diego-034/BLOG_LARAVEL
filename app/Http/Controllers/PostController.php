<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Illuminate\Support\Facades\Validator;
use Exception;

class PostController extends Controller
{
    private IModelRepository $IModelRepository;
    private Post $Post;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Post = new Post();
    }

    public function List(Request $params)
    {
        try {
            $data['Model'] = $this->Post;
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
                'post_title' => 'required|string',
                'post_body' => 'required|string'
            ]);

            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }

            $data = $params->all();
            $data['Model'] = $this->Post;
            $response = $this->IModelRepository->Insert($data);

            if (isset($response['Error'])) {
                return $this->SendError("Error", $response['Error']->getMessage(), 422);
            }
            return $this->SendResponse($response['OK'], "Insert OK");
        } catch (Exception $ex) {
            return $this->SendError("Error", $ex->getMessage(), 422);
        }
    }

    public function Update(Request $params, $id)
    {
        try {
            if ($id == null) {
                return $this->SendError("Error", ["Null"], 422);
            }
            $response = Validator::make($params->all(), [
                'post_title' => 'required|string',
                'post_body' => 'required|string'
            ]);

            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }
            $data = array();
            $data['Entity']['id'] = $id;
            $data['Entity']['post_title'] = $params->get('post_title');
            $data['Entity']['post_body'] = $params->get('post_body');
            $data['Model'] = $this->Post;
            $response = $this->IModelRepository->Update($data);
            if (isset($response['Error'])) {
                return $this->SendError("Error", $response['Error']->getMessage(), 422);
            }
            return $this->SendResponse($response['OK'], "Update OK");
        } catch (Exception $ex) {
            return $this->SendError("Error", $ex->getMessage(), 422);
        }
    }

    public function Delete(Request $params)
    {
        try {
            $response = Validator::make($params->all(), [
                'post_id' => 'required|numeric'
            ]);
            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }
            $data = array();
            $data['id'] = $params->get('post_id');
            $data['Model'] = $this->Post;
            $response = $this->IModelRepository->Delete($data);

            if ($response['OK'] == ['Not found']) {
                return $this->SendResponse(null, "Error");
            }
            if (isset($response['Error'])) {
                return $this->SendError("Error", $response['Error']->getMessage(), 422);
            }
            return $this->SendResponse($response['OK'], "Delete OK");
        } catch (Exception $ex) {
            return $this->SendError("Error", $ex->getMessage(), 422);
        }
    }

    public function Find($id)
    {
        try {
            if ($id == null) {
                return $this->SendError("Error", ["Null"], 422);
            }
            $data = array();
            $data['id'] = $id;
            $data['Model'] = $this->Post;
            $response = $this->IModelRepository->Find($data);

            if ($response['OK'] == ['Not found']) {
                return $this->SendResponse(null, "Error");
            }
            if (isset($response['Error'])) {
                return $this->SendError("Error", $response['Error']->getMessage(), 422);
            }
            return $this->SendResponse($response['OK'], "Find OK");
        } catch (Exception $ex) {
            return $this->SendError("Error", $ex->getMessage(), 422);
        }
    }

    public function Consult(Request $params)
    {
        try {
            $data = array(
                "Option"=>"S_IJ",
                "Table" => "posts",
                "Table2" => "users",
                "Col" => "users.id",
                "Col2" => "posts.user_id",
                "OP" => "=",
                "Columns"=>[
                    0=>"posts.post_title",
                    1=>"posts.post_body",
                    2=>"users.name",
                    3=>"users.lastname",
                ]);
            $response = $this->IModelRepository->Consult($data);

            if ($response['OK'] == ['Not found']) {
                return $this->SendResponse(null, "Error");
            }
            if (isset($response['Error'])) {
                return $this->SendError("Error", $response['Error']->getMessage(), 422);
            }
            return $this->SendResponse($response['OK'], "Find OK");
        } catch (Exception $ex) {
            return $this->SendError("Error", $ex->getMessage(), 422);
        }
    }
}
