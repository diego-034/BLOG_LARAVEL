<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Repositories\IRepository\IModelRepository;
use Illuminate\Support\Facades\DB;

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
            $response['OK'] = $this->Model::Find($data['id']);
            if ($response['OK'] == null) {
                $response['OK'] = ['Not found'];
            }
            return $response;
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Consult($data)
    {
        $response = array();
        try {
            switch ($data['Option']) {
                case "S":
                    $response['OK'] = DB::table($data['Table'])
                        ->select($data['Columns'])->get();
                    break;
                case "S_IJ":
                    $response['OK'] = DB::table($data['Table'])
                        ->join(
                            $data['Table2'],
                            $data['Col'],
                            $data['OP'],
                            $data['Col2']
                        )->select($data['Columns'])
                        ->get();
                    break;
                case "S_W":
                    $response['OK'] = DB::table($data['Table'])
                        ->select($data['Columns'])
                        ->where($data['Col'], $data['OP'], $data['Col2'])->get();
                    break;
                default:
                    $response['OK'] = null;
                    break;
            }
            if ($response['OK'] == null) {
                $response['OK'] == ['Not found'];
            }
            return $response;
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }
}
