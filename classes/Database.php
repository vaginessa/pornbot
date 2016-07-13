<?php
class Database extends DatabaseManager
{
	public function Database()
	{
		parent::__construct();
		return $this->db;
	}
	public function insert($row)
	{
		$this->db->prepare(
			'INSERT INTO `wp_posts` (post_author, post_date, post_content, post_title, post_status, comment_status, ping_status, post_name, post_modified, post_parent, guid, menu_order, post_type) VALUES(?, NOW(), ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?)');
		$this->db->bind_param(
			'dssssssdsds',
			$post_author = 1,
			$post_content = '',
			$post_title = $row->title,
			$post_status = 'publish',
			$comment_status = 'open',
			$ping_status = 'open',
			$post_name = $row->title_guid,
			$post_parent = 0,
			$guid = '',
			$menu_order = 0,
			$post_type = 'video'
		);
		$this->db->execute();
	}
	
	public function update($row)
	{
		
	}
}