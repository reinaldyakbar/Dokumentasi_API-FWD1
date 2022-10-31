<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Task extends RestController
{
    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $task = $this->Task_model->getTask();
        } else {
            $task = $this->Task_model->getTask($id);
        }

        if ($task) {
            $this->response([
                'status' => true,
                'message' => 'Success',
                'data' => $task
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Not found',
                'data' => $task
            ], 404);
        }
    }

    public function index_post()
    {
        $file = $_FILES['doc_url'];
        $path = "uploads/doc/";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $path_file = "";
        if (!empty($file['name'])) {
            $config['upload_path'] = './' . $path;
            $config['allowed_types'] = "doc|docx|pdf";
            $config['max_size'] = 10240;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('doc_url')) {
                $uploadData = $this->upload->data();
                // $path_file = './' . $path . $uploadData['file_name'];
                $path_file = $uploadData['file_name'];
            }
        }

        $date = $this->post('finish_date');
        $better_date = nice_date($date, 'Y-m-d');

        $data = [
            'category_id' => (int) $this->post('category_id'),
            'title' => $this->post('title'),
            'description' => $this->post('description'),
            'finish_date' => $better_date,
            'status' => $this->post('status'),
            'doc_url' => $path_file
        ];


        $task = $this->Task_model->addTask($data);

        if ($task > 0) {
            $this->response([
                'status' => true,
                'message' => 'Success insert to database'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed'
            ], 502);
        }
    }

    public function index_put()
    {
        $id = (int) $this->input->post('id');
        $data_doc = $this->Task_model->getTask($id);
        $file = $_FILES['doc_url'];
        $path = "uploads/doc/";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $path_file = "";
        if (!empty($file['name'])) {
            $config['upload_path'] = './' . $path;
            $config['allowed_types'] = "doc|docx|pdf";
            $config['max_size'] = 10240;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('doc_url')) {
                @unlink('./' . $path . $data_doc['doc_url']);

                $uploadData = $this->upload->data();
                // $path_file = './' . $path . $uploadData['file_name'];
                $path_file = $uploadData['file_name'];
                $data['doc_url'] = $path_file;
            }
        }

        $date = $this->input->post('finish_date');
        $better_date = nice_date($date, 'Y-m-d');

        $data['category_id'] = (int) $this->input->post('category_id');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['finish_date'] = $better_date;
        $data['status'] = $this->input->post('status');


        $task = $this->Task_model->updateTask($data, $id);

        if ($task > 0) {
            $this->response([
                'status' => true,
                'message' => 'Success update row'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update'
            ], 502);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $data_doc = $this->Task_model->getTask($id);
        $path = "uploads/doc/";
        $task = $this->Task_model->deleteTask($id);

        if ($task > 0) {
            @unlink('./' . $path . $data_doc['doc_url']);
            $this->response([
                'status' => true,
                'message' => 'Success to delete'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Not found id'
            ], 404);
        }
    }
}
