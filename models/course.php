<?php
	class Course
	{
		private $id;
		private $title;
		private $content;

		function __construct() { }

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
		}

		public function getTitle()
		{
			return $this->title;
		}

		public function setTitle($title)
		{
			$this->title = $title;
		}

		public function getContent()
		{
			return $this->content;
		}

		public function setContent($content)
		{
			$this->content = $content;
		}
	}