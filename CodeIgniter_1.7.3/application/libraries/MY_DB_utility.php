<?php
/**
 * MY_DB_utility Class
 *
 * This library extends the native DB Utility library.
 * It fixes a bug in csv_from_result() and add's html_entity decoding
 *
 * @package	CodeIgniter
 * @subpackage Libraries
 * @category	Database
 * @author Ollie Rattue
 */

class MY_DB_utility extends CI_DB_utility {
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function MY_Form_validation()
	{
		parent::CI_Form_validation();
	}
 
	// --------------------------------------------------------------------

	/**
	* Generate CSV from a query result object
	*
	* @access	public
	* @param	object	The query result object
	* @param	string	The delimiter - comma by default
	* @param	string	The newline character - \n by default
	* @param	string	The enclosure - double quote by default
	* @return	string
	*/

	function csv_from_result($query, $delim = ",", $newline = "\n", $enclosure = '"', $convert = FALSE)
	{
		// changed by Ollie to fix a posted bug - http://codeigniter.com/forums/viewthread/95597/

		if ( ! is_object($query) OR ! method_exists($query, 'list_fields')) 
		{
			show_error('You must submit a valid result object');
		}	

	     $out = '';

	     // First generate the headings from the table column names
	     foreach ($query->list_fields() as $name)
	     {
	     	$out .= $enclosure.str_replace($enclosure, $enclosure.$enclosure, $name).$enclosure.$delim;
	     }

	     $out = rtrim($out);
	     $out .= $newline;

	     // Next blast through the result array and build out the rows
	     foreach ($query->result_array() as $row)
	     {
			// print_r($query);

	     	// Added for html entity decoding
	     	// Could of done one foreach but then you have to check $convert every time which seems pointless as it never changes
	     	// More code but better! 

	        if ($convert)
	        {
				foreach ($row as $key => $item)
		        {
					// echo '<p>key '.$key;
					// echo '<br />item before '.$item;

					$item = html_entity_decode($item, ENT_QUOTES, 'UTF-8'); // added by Ollie to remove html entities
					// echo '<br />item after '.$item.'</p>';

					$out .= $enclosure.str_replace($enclosure, $enclosure.$enclosure, $item).$enclosure.$delim;	
		        }
	        }
	        else
	        {
				foreach ($row as $item)
		       	{
					$out .= $enclosure.str_replace($enclosure, $enclosure.$enclosure, $item).$enclosure.$delim;	
		       	} 
	        }

	     	$out = rtrim($out);
	     	$out .= $newline;
	     }

	     // echo $out;
	     return $out;
	}

	// --------------------------------------------------------------------
}
?>