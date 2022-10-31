<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Task_Categories extends RestController
{
    public function index_get()
    {
        $id = $this->get('id');

        if ($id == null) {
            $task_categories = $this->Task_Categories_Model->getTaskCategories();
        } else {
            $task_categories = $this->Task_Categories_Model->getTaskCategories($id);
        }

        if ($task_categories) {
            $this->response([
                'status' => true,
                'message' => 'Sucess',
                'data' => $task_categories
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Not found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'name' => $this->post('name')
        ];

        $task_categories = $this->Task_Categories_Model->addTaskCategories($data);

        if ($task_categories > 0) {
            $this->response([
                'status' => true,
                'message' => 'Success to insert database'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to insert database'
            ], 500);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');

        $beforeUpdate = $this->Task_Categories_Model->getTaskCategories($id);

        $data = [
            'name' => $this->put('name')
        ];

        $task_categories = $this->Task_Categories_Model->updateTaskCategories($id, $data);

        if ($task_categories > 0) {
            $afterUpdate = $this->Task_Categories_Model->getTaskCategories($id);
            $this->response([
                'status' => true,
                'message' => 'Success to update',
                'before update' => $beforeUpdate,
                'after update' => $afterUpdate
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to update'
            ], 500);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $task_categories = $this->Task_Categories_Model->deleteTaskCategories($id);

        if ($task_categories > 0) {
            $this->response([
                'status' => true,
                'message' => 'Success to delete ',
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to delete'
            ], 500);
        }
    }
}
