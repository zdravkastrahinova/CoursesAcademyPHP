<?php
   class Comment
   {
       private $id;
       private $course_id;
       private $user_id;
       private $title;
       private $content;

       public function getId()
       {
           return $this->id;
       }

       public function setId($id)
       {
           $this->id = $id;
       }

       public function getCourseId()
       {
           return $this->course_id;
       }

       public function setCourseId($course_id)
       {
           $this->course_id = $course_id;
       }

       public function getUserId()
       {
           return $this->user_id;
       }

       public function setUserId($user_id)
       {
           $this->user_id = $user_id;
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
