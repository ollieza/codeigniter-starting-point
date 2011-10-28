<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('phpass-0.1/PasswordHash.php');

define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', FALSE);

/**
 * SimpleLoginSecure Class
 *
 * Makes authentication simple and secure.
 *
 * Simplelogin expects the following database setup. If you are not using 
 * this setup you may need to do some tweaking.
 *   
 * 
 *   CREATE TABLE `users` (
 *     `user_id` int(10) unsigned NOT NULL auto_increment,
 *     `user_email` varchar(255) NOT NULL default '',
 *     `user_pass` varchar(60) NOT NULL default '',
 *     `user_date` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'Creation date',
 *     `user_modified` datetime NOT NULL default '0000-00-00 00:00:00',
 *     `user_last_login` datetime NULL default NULL,
 *     PRIMARY KEY  (`user_id`),
 *     UNIQUE KEY `user_email` (`user_email`),
 *   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * 
 * @package   SimpleLoginSecure
 * @version   1.0.1
 * @author    Alex Dunae, Dialect <alex[at]dialect.ca>
 * @copyright Copyright (c) 2008, Alex Dunae
 * @license   http://www.gnu.org/licenses/gpl-3.0.txt
 * @link      http://dialect.ca/code/ci-simple-login-secure/
 */

class SimpleLoginSecure
{
	var $CI;
	var $user_table = 'users';
	
	// Constructor
	public function __construct()
	{
		if (!isset($this->CI))
		{
			$this->CI =& get_instance();
		}
		
		$this->CI->load->model('users_model');
		$this->CI->load->model('password_reset_model');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Create a user account
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	
	function create($user_email = NULL, $user_pass = NULL, $user_details = array(), $auto_login = TRUE) 
	{
		$this->CI =& get_instance();
		
		// Make sure account info was sent
		if (!$user_email OR !$user_pass) 
		{
			return FALSE;
		}
		
		if (!$this->is_email_available($user_email))
		{
			return FALSE;
		}

		// Hash user_pass using phpass
		$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$user_pass_hashed = $hasher->HashPassword($user_pass);

		// Insert account into the database
		$data = array(
					'user_email' 		=> $user_email,
					'user_pass' 		=> $user_pass_hashed,
					'user_date' 		=> date('c'),
					'user_modified' 	=> date('c')
					);
		
		if (is_array($user_details))
		{
			$data = array_merge($data, $user_details);
		}
		
		$new_user = $this->CI->users_model->update_user($data, 'add');
		
		if (!$new_user)
		{
			// There was a problem! 	
			return FALSE;
		} 
			
		$new_user_id = $new_user;
			
		if ($auto_login)
		{
			$this->auto_login($new_user_id);
		}
		
		return $new_user_id;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Login and sets session variables
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	
	// Modified so that a user could enter either a username or email_address
	
	function login($username_or_email = '', $user_pass = '') 
	{
		$this->CI =& get_instance();

		if ($username_or_email == '' OR $user_pass == '')
		{
			return FALSE;
		}

		// Check if already logged in
		if ($this->is_logged_in())
		{
			return TRUE;
		}
		
		// Check against user table
		$query = $this->CI->users_model->get_user($username_or_email);
	
		if ($query->num_rows() > 0) 
		{
			$user = $query->row_array(); 

			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

			if(!$hasher->CheckPassword($user_pass, $user['user_pass']))
				return FALSE;

			// Destroy old session
			$this->CI->session->sess_destroy();
				
			// Create a fresh, brand new session
			$this->CI->session->sess_create();
			
			$this->CI->users_model->update_user(array('user_last_login' => date('Y-m-d H:i:s')), 'edit', $user['user_id']);

			// Set session data
			if (!$user['user_last_login'])
			{
				$user_data['first_login'] = TRUE;
			}
				
			$user_data['logged_in'] = TRUE;
			$user_data['user_email'] = $user['user_email'];
			$user_data['user_id'] = $user['user_id'];
			$user_data['user_first_name'] = $user['user_first_name'];
			$user_data['user_last_name'] = $user['user_last_name'];
			$this->CI->session->set_userdata($user_data);
			
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}	
	}
	
	// --------------------------------------------------------------------

	/**
	 * Auto login - forces a login
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	
	function auto_login($user_id = NULL)
	{	
		$query = $this->CI->users_model->get_user_by_id($user_id);
	
		if ($query->num_rows() == 0) 
		{
			return FALSE;
		}
		
		$user = $query->row_array(); 
		
		$this->CI->users_model->update_user(array('user_last_login' => date('Y-m-d H:i:s')), 'edit', $user['user_id']);

		// Set session data
		if (!$user['user_last_login'])
		{
			$user_data['first_login'] = TRUE;
		}
		
		$user_data['logged_in'] = TRUE;
		$user_data['user_email'] = $user['user_email'];
		$user_data['user_id'] = $user['user_id'];
		$user_data['user_first_name'] = $user['user_first_name'];
		$user_data['user_last_name'] = $user['user_last_name'];		
		$this->CI->session->set_userdata($user_data);
		
		return TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Logout user
	 *
	 * @access	public
	 * @return	void
	 */
	
	function logout()
	{
		$unset_items = array(
							'logged_in' => '', 
							'user_username' => '',
							'user_email' => '',
							'user_id' => '',
							'user_role' => '',
							'user_first_name' => '',
							'user_last_name' => '',
							'user_active_membership' => '',
							'first_login' => '',
							);

		$this->CI->session->unset_userdata($unset_items);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Delete user
	 *
	 * @access	public
	 * @param integer
	 * @return	bool
	 */
	
	function delete($user_id) 
	{		
		return $this->CI->users_model->delete_user($user_id);
	}
	
	// --------------------------------------------------------------------

	function is_logged_in()
	{
		return $this->CI->session->userdata('logged_in');
	}

	// --------------------------------------------------------------------
		
	function is_logged_in_admin()
	{
		if ($this->CI->session->userdata('user_role') == 'admin')
		{
			return TRUE;
		}
	}
	
	// --------------------------------------------------------------------
	
	function is_username_available($username)
	{
		$users = $this->CI->users_model->get_user_by_username($username);
		return $users->num_rows() == 0;
	}
	
	// --------------------------------------------------------------------

	function is_email_available($email_address)
	{
		$users = $this->CI->users_model->get_user_by_email($email_address);
		return $users->num_rows() == 0;
	}
	
	// --------------------------------------------------------------------
	
	// returns the opposite of is_email_available
	
	function is_email_registered($email_address)
	{
		$users = $this->CI->users_model->get_user_by_email($email_address);
		return $users->num_rows() > 0;
	}
	
	// --------------------------------------------------------------------

	// returns the opposite of is_username_available	

	function is_username_registered($username)
	{	
		$users = $this->CI->users_model->get_user_by_email($email_address);
		return $users->num_rows() > 0;
	}
	
	// --------------------------------------------------------------------
	
	function reset_password($user_email = NULL)
	{
		$user_id = $this->CI->users_model->get_userid_from_email($user_email);
		
		if (!$user_id)
		{
			return FALSE;
		}
			
		$reset_code = $this->CI->password_reset_model->create_reset_code($user_id);

		if (!$reset_code)
		{
			return FALSE;
		}
		
		// On successful insert email reset url to user
	  	$reset_url = base_url()."amnesia/reset_password/{$reset_code}";
	
		$this->CI->autoresponder->to_email($user_email);
		$this->CI->autoresponder->variable_values(array('reset_url' => $reset_url, 'website_name' => WEBSITE_NAME));
		return $this->CI->autoresponder->send('reset_password');
	}

	// --------------------------------------------------------------------
	
	function save_new_reset_password($reset_code = '', $user_newpass = '', $auto_login = TRUE) 
	{
		// Make sure account info was sent
        if ($reset_code == '' OR $user_newpass == '') 
		{
            return FALSE;
        }
		
		$user_id = $this->get_user_id_from_reset_code($reset_code);
		
		// Hash user_newpass using phpass
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $user_pass_hashed = $hasher->HashPassword($user_newpass);

		$password_saved = $this->CI->password_reset_model->save_reset_password($user_id, $user_pass_hashed);
		
		if ($auto_login & $password_saved)
		{
			$user_email = $this->CI->users_model->get_email_from_userid($user_id);
			
			if (!$user_email)
			{
				return FALSE;
			}
			
			$this->login($user_email, $user_newpass);
		}
		
		return $password_saved;
	}

	// --------------------------------------------------------------------
		
	function get_user_id_from_reset_code($reset_code = NULL)
	{
		return $this->CI->password_reset_model->get_user_id_from_reset_code($reset_code);
	}

	// --------------------------------------------------------------------
		
	function valid_reset_code($reset_code = NULL)
	{
		if (!$this->get_user_id_from_reset_code($reset_code))
		{
			return FALSE;
		}	
		
		return TRUE;
	}
	
	// --------------------------------------------------------------------
	
	function set_new_password($user_id = '', $user_newpass = '') 
	{
		// Check if already logged in
		if (!$this->is_logged_in())
		{
			return FALSE;
		}
			
		// Make sure account info was sent
        if ($user_id == '' OR $user_newpass == '') 
		{
            return FALSE;
        }

        // Make sure $user_id is numeric
        if (!is_numeric($user_id)) 
		{
            return FALSE;
        }

        $this->CI->db->where('user_id', $user_id);
        $query = $this->CI->db->get_where($this->user_table);
        $user_data = $query->row_array();

        // Hash user_newpass using phpass
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $user_pass_hashed = $hasher->HashPassword($user_newpass);
		
		// Insert new password into table
		$new_user = array('user_pass' => $user_pass_hashed);
		$this->CI->users_model->update_user($new_user, 'edit', $user_data['user_id']);

        return TRUE;
    }
	
	// --------------------------------------------------------------------

	function save_profile($user_id = NULL, $user_details = array()) 
	{		
		if ($this->CI->users_model->update_user($user_details, 'edit', $user_id))
		{
			// Add new values to session if they have changed
			$session_data = array();
			
			if (isset($user_details['user_email']))
			{
				$session_data['user_email'] = $user_details['user_email'];
			}

			if (isset($user_details['user_first_name']))
			{
				$session_data['user_first_name'] = $user_details['user_first_name'];
			}

			if (isset($user_details['user_last_name']))
			{
				$session_data['user_last_name'] = $user_details['user_last_name'];
			}
			
			$this->CI->session->set_userdata($session_data);
			return TRUE;           
		} 
	
		return FALSE;
	}
	
	// --------------------------------------------------------------------
	
	function verify_current_password($user_id = '',$current_password = '')
	{
		$query = $this->CI->users_model->get_user_by_id($user_id);
        $user_data = $query->row_array();

        // Hash user_newpass using phpass
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		
        if ($hasher->CheckPassword($current_password, $user_data['user_pass']))
		{
			return TRUE;
		}
		return FALSE;

	}

	// --------------------------------------------------------------------
}
?>