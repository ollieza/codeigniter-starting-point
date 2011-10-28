<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * This class is written based entirely on the work found below
 * www.techbytes.co.in/blogs/2006/01/15/consuming-rss-with-php-the-simple-way/
 * All credit should be given to the original author
*/

class RSSParser {
	
    var $feed_uri = NULL; // Feed URI
    var $data = array(); // Associative array containing all the feed items
    var $channel_data = array(); // Store RSS Channel Data in an array
    var $feed_unavailable; // Boolean variable which indicates whether an RSS feed was unavailable
    var $cache_life = 0; // Cache lifetime
    var $cache_dir = './application/cache/'; // Cache directory
	var $write_cache_flag = FALSE; // Flag to write to cache - defaulted to false
    
	function RSSParser() 
	{
		$this->CI =& get_instance();
		
		$this->current_feed['title'] = '';
		$this->current_feed['description'] = '';
		$this->current_feed['link'] = '';
    }

	// --------------------------------------------------------------------
	
    function parse()
	{
        // Are we caching?
        if ($this->cache_life != 0)
        {
            $filename = $this->cache_dir.'rss_Parse_'.md5($this->feed_uri);

            // Is there a cache file ?
            if (file_exists($filename))
            {
                // Has it expired?
                $timedif = (time() - filemtime($filename));
				
                if ($timedif < ( $this->cache_life * 60))
                {
					$rawFeed = file_get_contents($filename);
                }
				else
				{
				   // So raise the falg
				   $this->write_cache_flag = true;
				}
            }
			else
			{
               // Raise the flag to write the cache
               $this->write_cache_flag = true;
            }
       	}

		// Reset
	   	$this->current_feed['title'] = '';
       	$this->current_feed['description'] = '';
       	$this->current_feed['link'] = '';
       	$this->data = array();
       	$this->channel_data = array();

      	// Parse the document
      	if (!isset($rawFeed))
	  	{
			$rawFeed = file_get_contents($this->feed_uri);
	  	}
	  
      	$xml = new SimpleXmlElement($rawFeed);

      	// Assign the channel data
      	$this->channel_data['title'] = $xml->channel->title;
      	$this->channel_data['description'] = $xml->channel->description;

      	// Build the item array
      	foreach ($xml->channel->item as $item)
      	{
           	$data = array();
           	$data['title'] = $item->title;
           	$data['description'] = $item->description;
           	$data['pubDate'] = $item->pubDate;
           	$data['link'] = $item->link;
           	$this->data[] = $data;
      	}

      	// Do we need to write the cache file?
      	if ($this->write_cache_flag)
      	{
            if (!$fp = @fopen($filename, 'wb'))
            {
                echo "ERROR";
                log_message('error', "Unable to write cache file: ");
                return;
            }
          
  			flock($fp, LOCK_EX);
            fwrite($fp, $rawFeed);
            flock($fp, LOCK_UN);
            fclose($fp);
      }

      return TRUE;
  	}

	// --------------------------------------------------------------------
		
	function set_cache_life($period = NULL)
	{
		$this->cache_life = $period;
	}
	
	// --------------------------------------------------------------------
	
	function set_feed_url($url = NULL)
	{
		$this->feed_uri = $url;
	}

	// --------------------------------------------------------------------
		
    /* Return the feeds one at a time: when there are no more feeds return false
     * @param No of items to return from the feed
     * @return Associative array of items
    */
    function getFeed($num)
	{
        $c = 0;
        $return = array();
    
    	foreach ($this->data AS $item)
        {
            $return[] = $item;
            $c++;
        
    		if ($c == $num)
			{
				break;
			}
        }
        
		return $return;
    }

	// --------------------------------------------------------------------
	
    /* Return channel data for the feed */
    function & getChannelData()
	{
        $flag = false;

		if (!empty($this->channel_data))
		{
            return $this->channel_data;
        }
		else
		{
            return $flag;
        }
    }

	// --------------------------------------------------------------------
	
    /* Were we unable to retreive the feeds ?  */
    function errorInResponse()
	{
       return $this->feed_unavailable;
    }

	// --------------------------------------------------------------------
}

/* End of file RSSParser.php */
/* Location: ./application/libraries/RSSParser.php */