<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter ACL Class
 *
 * This class enables apply access to controllers, controller and models, as well as more fine tuned access '
 * at code level.
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @category    Models
 * @author      David Freerksen
 * @link        https://github.com/dfreerksen/ci-acl
 */
class Acl_model extends App_Model {

	/**
	 * Get access from database
	 *
	 * @param   int $member
	 * @return  array
	 */
	public function has_permission($key = '')
	{
		// User member
		$member = $this->acl->member();

		log_activity(json_encode($member) . ' member');

		// Permissions
		$access = $this->access($member);
		log_activity(json_encode($access) . ' $access');
		// Check if the key is in the list of access
		if(in_array(strtolower($key), $access)){
			log_activity('in_array');
		}
		return in_array(strtolower($key), $access);
	}

	// --------------------------------------------------------------------

	/**
	 * Get current user by session info
	 *
	 * @return  array
	 */
	public function user_member($user = 0)
	{
		$query = $this->db->select("members.id" ." as member_id")
			->from($this->acl->acl_table_users.' u')
			->join('clients', 'clients.userid = u.client_id')
			->join('members', 'clients.acl_member = members.id')
			->where("u.staffid", $user)
			->get();

		// User was found
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();

			return $row['member_id'];
		}

		// No member
		return 0;
	}

	// --------------------------------------------------------------------

	/**
	 * Get access from database
	 *
	 * @param   int $member
	 * @return  array
	 */
	public function access($member = 0)
	{
		$query = $this->db->select("p.key as k")
			->from($this->acl->acl_table_access.' p')
			->join($this->acl->acl_table_member_access.' rp', "rp.access_id = p.id")
			->where("rp.member_id", $member)
			->get();
		$last_query = $this->db->last_query();
		log_activity(json_encode($last_query));
		$access = array();
		log_activity(json_encode($access));
		// Add to the list of access
		foreach ($query->result_array() as $row)
		{
			$access[] = strtolower($row['k']);
		}

		return $access;
	}

}
// END Acl_model class

/* End of file acl_model.php */
/* Location: ./application/models/acl_model.php */