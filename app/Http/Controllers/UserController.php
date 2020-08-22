<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    private IModelRepository $IModelRepository;
    private User $User;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->User = new User();
    }

    public function List(Request $params)
    {
        try {
            $data['Model'] = $this->User;
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
                'name' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
                'confirm_password' => 'required|same:password'
            ]);

            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }

            $data = $params->all();
            $data['password'] = bcrypt($data['password']);
            $data['Model'] = $this->User;
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
                'name' => 'required|string',
                'lastname' => 'required|string',
                'password' => 'required|string',
                'confirm_password' => 'required|same:password'
            ]);

            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }
            $data = array();
            $data['Entity']['id'] = $id;
            $data['Entity']['name'] = $params->get('name');
            $data['Entity']['lastname'] = $params->get('lastname');
            $data['Entity']['password'] = bcrypt($params->get('password'));
            $data['Model'] = $this->User;
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
                'user_id' => 'required|numeric'
            ]);
            if ($response->fails()) {
                return $this->SendError("Error", $response->errors(), 422);
            }
            $data = array();
            $data['id'] = $params->get('user_id');
            $data['Model'] = $this->User;
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
            $data['Model'] = $this->User;
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
