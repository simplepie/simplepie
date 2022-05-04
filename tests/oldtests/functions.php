<?php

class SimplePie_Unit_Test2_Group extends Unit_Test2_Group {}

class SimplePie_Unit_Test2 extends Unit_Test2 {}

class SimplePie_Feed_Test extends SimplePie_Unit_Test2
{
	function feed()
	{
		$feed = new SimplePie();
		$feed->set_raw_data($this->data);
		$feed->enable_cache(false);
		$feed->init();
		return $feed;
	}
}

class SimplePie_Feed_Author_Test extends SimplePie_Feed_Test
{
	function author()
	{
		$feed = $this->feed();
		if ($author = $item->get_author())
		{
			return $author;
		}

		return false;
	}
}

class SimplePie_First_Item_Test extends SimplePie_Feed_Test
{
	function first_item()
	{
		$feed = $this->feed();
		if ($item = $feed->get_item(0))
		{
			return $item;
		}

		return false;
	}
}

class SimplePie_First_Item_Author_Test extends SimplePie_First_Item_Test
{
	function author()
	{
		if ($item = $this->first_item())
		{
			if ($author = $item->get_author())
			{
				return $author;
			}
		}
		return false;
	}
}

class SimplePie_First_Item_Category_Test extends SimplePie_First_Item_Test
{
	function category()
	{
		if ($item = $this->first_item())
		{
			if ($category = $item->get_category())
			{
				return $category;
			}
		}
		return false;
	}
}

class SimplePie_First_Item_Contributor_Test extends SimplePie_First_Item_Test
{
	function contributor()
	{
		if ($item = $this->first_item())
		{
			if ($contributor = $item->get_contributor())
			{
				return $contributor;
			}
		}
		return false;
	}
}

class SimplePie_Feed_Image_Height_Test extends SimplePie_Feed_Test
{
	function test()
	{
		$feed = $this->feed();
		$this->result = $feed->get_image_height();
	}
}

class SimplePie_Feed_Image_Link_Test extends SimplePie_Feed_Test
{
	function test()
	{
		$feed = $this->feed();
		$this->result = $feed->get_image_link();
	}
}

class SimplePie_Feed_Image_Title_Test extends SimplePie_Feed_Test
{
	function test()
	{
		$feed = $this->feed();
		$this->result = $feed->get_image_title();
	}
}

class SimplePie_Feed_Image_URL_Test extends SimplePie_Feed_Test
{
	function test()
	{
		$feed = $this->feed();
		$this->result = $feed->get_image_url();
	}
}

class SimplePie_Feed_Image_Width_Test extends SimplePie_Feed_Test
{
	function test()
	{
		$feed = $this->feed();
		$this->result = $feed->get_image_width();
	}
}

class SimplePie_Feed_Language_Test extends SimplePie_Feed_Test
{
	function test()
	{
		$feed = $this->feed();
		$this->result = $feed->get_language();
	}
}

class SimplePie_Feed_Link_Test extends SimplePie_Feed_Test
{
	function test()
	{
		$feed = $this->feed();
		$this->result = $feed->get_link();
	}
}

class SimplePie_Feed_Title_Test extends SimplePie_Feed_Test
{
	function test()
	{
		$feed = $this->feed();
		$this->result = $feed->get_title();
	}
}

class SimplePie_First_Item_Author_Name_Test extends SimplePie_First_Item_Author_Test
{
	function test()
	{
		if ($author = $this->author())
		{
			$this->result = $author->get_name();
		}
	}
}

class SimplePie_First_Item_Category_Label_Test extends SimplePie_First_Item_Category_Test
{
	function test()
	{
		if ($category = $this->category())
		{
			$this->result = $category->get_label();
		}
	}
}

class SimplePie_First_Item_Content_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			$this->result = $item->get_content();
		}
	}
}

class SimplePie_First_Item_Contributor_Name_Test extends SimplePie_First_Item_Contributor_Test
{
	function test()
	{
		if ($contributor = $this->contributor())
		{
			$this->result = $contributor->get_name();
		}
	}
}

class SimplePie_First_Item_Date_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			$this->result = $item->get_date('U');
		}
	}
}

class SimplePie_First_Item_Description_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			$this->result = $item->get_description();
		}
	}
}

class SimplePie_First_Item_ID_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			$this->result = $item->get_id();
		}
	}
}

class SimplePie_First_Item_Latitude_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			$this->result = $item->get_latitude();
		}
	}
}

class SimplePie_First_Item_Longitude_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			$this->result = $item->get_longitude();
		}
	}
}

class SimplePie_First_Item_Permalink_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			$this->result = $item->get_permalink();
		}
	}
}

class SimplePie_First_Item_Title_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			$this->result = $item->get_title();
		}
	}
}

class SimplePie_iTunesRSS_Channel_Block_Test extends SimplePie_First_Item_Test
{
	function test()
	{
		if ($item = $this->first_item())
		{
			if ($enclosure = $item->get_enclosure())
			{
				if ($restriction = $enclosure->get_restriction())
				{
					$this->result = $restriction->get_relationship();
					return;
				}
			}
		}
		$this->result = false;
	}
}

?>
