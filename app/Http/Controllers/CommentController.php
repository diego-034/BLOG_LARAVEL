<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Repositories\IRepository\IModelRepository;
use Illuminate\Support\Facades\Validator;
use Exception;


class CommentController extends Controller
{
    private IModelRepository $IModelRepository;
    private Comment $Comment;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Comment = new Comment();
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
                'post_id' => 'required|string'
            ]);

            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }

            $data = $params->all();
            $data['Model'] = $this->Comment;
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
                'comment' => 'required|string'
            ]);

            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }
            $data = array();
            $data['Entity']['id'] = $id;
            $data['Entity']['comment'] = $params->get('comment');
            $data['Model'] = $this->Comment;
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
                'comment_id' => 'required|numeric'
            ]);
            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }
            $data = array();
            $data['id'] = $params->get('comment_id');
            $data['Model'] = $this->Comment;
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
            $data['Model'] = $this->Comment;
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
}
