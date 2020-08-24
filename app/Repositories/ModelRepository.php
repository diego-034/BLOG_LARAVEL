<?php

namespace App\Repositories;

use App\Models\Comment;
use App\User;
use App\Models\Post;
use App\Repositories\IRepository\IModelRepository;

use Exception;

class ModelRepository implements IModelRepository
{
    protected $Model;

    private function SetModel($Model)
    {
        $this->Model = $Model;
    }

    public function List($data = null)
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::all();
            return $response;
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Insert($data)
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::create($data);
            return $response;
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Update($data)
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::find($data['Entity']['id']);
            if ($response['OK'] == null) {
                $response['OK'] = ['Not found'];
                return $response;
            }
            $response['OK'] = $this->Model->where('id', $data['Entity']['id'])->update($data['Entity']);

            return $response;
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Delete($data)
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::find($data['id']);
            if ($response['OK'] == null) {
                $response['OK'] = ['Not found'];
                return $response;
            }
            $response['OK'] = $this->Model::destroy($data['id']);
            return $response;
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Find($data)
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::find($data['id']);
            if ($response['OK'] == null) {
                $response['OK'] = ['Not found'];
            }
            return $response;
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }
}
