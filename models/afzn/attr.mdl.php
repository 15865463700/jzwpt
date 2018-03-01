<?php

class Mdl_Afzn_Attr extends Mdl_Table
{
    protected $_table = 'vrqj_attr';
    protected $_pk = 'vrqj_id,attr_id,attr_value_id';
    protected $_cols = 'vrqj_id,attr_id,attr_value_id';

    public function update($vrqj_id, $data, $checked = false)
    {
        if (!$vrqj_id = intval($vrqj_id)) {
            return false;
        }
        $sql = array();
        foreach ((array)$data as $k => $v) {
            foreach ((array)$v as $kk => $vv) {
                if (is_numeric($kk) && is_numeric($vv)) {
                    $sql[] = "('{$vrqj_id}', '{$k}', '{$vv}')";
                }
            }
        }
        $this->db->Execute("DELETE FROM " . $this->table($this->_table) . " WHERE vrqj_id='$vrqj_id'");
        if ($sql) {
            $sql = "INSERT INTO " . $this->table($this->_table) . " VALUES" . implode(',', $sql);
            $this->db->Execute($sql);
        }
    }

    public function attrs_by_vrqj($vrqj_id)
    {
        if (!$vrqj_id = intval($vrqj_id)) {
            return false;
        }
        $attrs = array();
        $sql = "SELECT * FROM " . $this->table($this->_table) . " WHERE vrqj_id='$vrqj_id'";
        if ($rs = $this->db->Execute($sql)) {
            while ($row = $rs->fetch()) {
                $attrs[$row['attr_value_id']] = $row;
            }
        }
        return $attrs;
    }

    public function attrs_ids_by_vrqj($vrqj_id)
    {
        if (!$vrqj_id = intval($vrqj_id)) {
            return false;
        }
        $attrs = array();
        $sql = "SELECT attr_value_id FROM " . $this->table($this->_table) . " WHERE vrqj_id='$vrqj_id'";
        if ($rs = $this->db->Execute($sql)) {
            while ($row = $rs->fetch()) {
                $attrs[] = $row['attr_value_id'];
            }
        }
        return $attrs;
    }
}
