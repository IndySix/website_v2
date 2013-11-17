<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_Tokens extends Core_Model{

        function __construct() {
                $this->deleteExpired();
        }

        function create($user_id, $type){
                $data['token']   = randomString(32);
                $data['user_id'] = $user_id;
                $data['type']    = $type;
                $this->db->insert('Tokens', $data);
                return $data['token'];
        }

        function get($token) {
                $this->db->reset();
                $this->db->where('token', $token);
                $data = $this->db->get('Tokens');
                if(!empty($data))
                        return $data[0];
                return null;
        }

        function validate($token) {
                $token = $this->get($token);
                if( $token != null )
                        return true;
                return false;
        }

        function countType($user_id, $type){
                $sql = 'SELECT count(*) FROM Tokens WHERE user_id = ? AND type = ?';
                $bind[] = $user_id;
                $bind[] = $type;
                $data = $this->db->query($sql, $bind);
                return $data[0][0];
        }

        function deleteType($user_id, $type){
                $sql = 'DELETE FROM Tokens WHERE user_id = ? AND type = ?';
                $bind[] = $user_id;
                $bind[] = $type;
                $this->db->query($sql, $bind);
        }

        function delete($token){
                $this->db->where('token', $token);
                $this->db->delete('Tokens');
        }

        private function deleteExpired(){
                $sql = 'DELETE FROM Tokens WHERE createDate < now()- interval 15 MINUTE';
                $this->db->query($sql);
        }
}