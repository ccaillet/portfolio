<?php

/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 15.03.17
 * Time: 09:15
 */
class Domain_model extends CI_Model
{
    const TABLE = 'domains';

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }

    public function findOne($id)
    {
      $domains = $this->db->get_where(self::TABLE, ['id' => $id])->result_object();
      if (count($domains) > 0) {
        return $domains[0];
      }
      return null;
    }

    public function add($domain)
    {
      $domain = $this->clean($domain);
      $this->db->insert(self::TABLE, $domain);
      return $this->db->insert_id();
    }

    public function edit($domain)
    {
      $domain = $this->clean($domain);
      $this->db->where('id', $domain->id);
      return $this->db->update(self::TABLE, $domain);
    }

    public function delete($domain)
    {
      $this->db->where('id', $domain->id);
      return $this->db->delete(self::TABLE);
    }

    public function clean($domain)
    {
      $domain->name = trim($domain->name);
      return $domain;
    }
}
