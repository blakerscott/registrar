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

			function addCourse($course)
      {
          $GLOBALS['DB']->exec("INSERT INTO students_courses (course_id, student_id) VALUES ({$course->getId()}, {$this->getId()});");
      }

      function getCourses()
      {
          $query = $GLOBALS['DB']->query("SELECT course_id FROM students_courses WHERE student_id = {$this->getId()};");
          $course_ids = $query->fetchAll(PDO::FETCH_ASSOC);

					$courses = array();
          foreach($course_ids as $id) {
              $course_id = $id['course_id'];
              $result = $GLOBALS['DB']->query("SELECT * FROM courses WHERE id = {$course_id};");
              $returned_course = $result->fetchAll(PDO::FETCH_ASSOC);

              $course_name = $returned_course[0]['course_name'];
              $id = $returned_course[0]['id'];
							$course_num = $returned_course[0]['course_num'];
              $new_course = new Course($id, $course_name, $course_num);
              array_push($courses, $new_course);
          }
          return $courses;
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

			function delete()
      {
          $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
          $GLOBALS['DB']->exec("DELETE FROM students_courses WHERE student_id = {$this->getId()};");
      }

	}
 ?>
