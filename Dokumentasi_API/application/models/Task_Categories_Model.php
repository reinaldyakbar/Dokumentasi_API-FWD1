<?php

class Task_Categories_Model extends CI_Model
{
    public function getTaskCategories($id = null)
    {
        if ($id == null) {
            return $this->db->get('task_categories')->result_array();
        } else {
            return $this->db->get_where('task_categories', ['id' => $id])->row_array();
        }
    }

    public function addTaskCategories($data)
    {
        $this->db->insert('task_categories', $data);
        return $this->db->affected_rows();
    }

    public function updateTaskCategories($id, $data)
    {
        $this->db->update('task_categories', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteTaskCategories($id)
    {
        $this->db->delete('task_categories', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
