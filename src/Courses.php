<?php
	 class Student
		{
			  private $id;
				private $name;
				private $course_num;

		 function __construct($id = null, $name, $course_num)
		 {
			 	$this->id = $id;
				$this->name = $name;
				$this->course_num = $course_num;

			}

			function getId()
			{
					return $this->id;
			}

			function getName()
      {
          return $this->name;
      }

      function getCourseNum()
      {
          return $this->course_num;
      }

      function setName($new_name)
      {
          $this->name = (string) $new_name;
      }

      function setCourseNum($new_course_num)
      {
          $this->course_num = $new_course_num;
      }



	}
 ?>
