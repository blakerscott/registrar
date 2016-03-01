<?php
	 class Student
		{
			  private $id;
				private $name;
				private $add_date;

		 function __construct($id = null, $name, $add_date)
		 {
			 	$this->id = $id;
				$this->name = $name;
				$this->add_date = $add_date;

			}

			function getId()
			{
					return $this->id;
			}

			function getName()
      {
          return $this->name;
      }

      function getAddDate()
      {
          return $this->add_date;
      }

      function setName($new_name)
      {
          $this->name = (string) $new_name;
      }

      function setAddDate($new_add_date)
      {
          $this->add_date = $new_add_date;
      }

			function save()
			{
					$GLOBALS['DB']->exec("INSERT INTO students (name, add_date) VALUES ('{$this->getName()}', '{$this->getAddDate()}')");
					$this->id = $GLOBALS['DB']->lastInsertId();
			}

			static function getAll()
			{
					$returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
					$students = array();
					foreach($returned_students as $student)
					{
							$name = $student['name'];
							$id = $student['id'];
							$add_date = $student['add_date'];
							$new_student = new Student($id, $name, $add_date);

							array_push($students, $new_student);
					}
					return $students;
			}

			static function deleteAll()
			{
					$GLOBALS['DB']->exec("DELETE FROM students;");
			}

			static function find($search_id)
			{
					$found_student = null;
					$students = Student::getAll();
					foreach($students as $student) {
							$student_id = $student->getId();
							if ($student_id == $search_id) {
									$found_student = $student;
							}
					}
					return $found_student;
			}


	}
 ?>
