<?php
	 class Course
		{
			  private $id;
				private $course_name;
				private $course_num;

		 function __construct($id = null, $course_name, $course_num)
		 {
			 	$this->id = $id;
				$this->course_name = $course_name;
				$this->course_num = $course_num;

			}

			function getId()
			{
					return $this->id;
			}

			function getCourseName()
      {
          return $this->course_name;
      }

      function getCourseNum()
      {
          return $this->course_num;
      }

      function setCourseName($new_course_name)
      {
          $this->course_name = (string) $new_course_name;
      }

      function setCourseNum($new_course_num)
      {
          $this->course_num = $new_course_num;
      }

			function save()
			{
					$GLOBALS['DB']->exec("INSERT INTO courses (course_name, course_num) VALUES ('{$this->getCourseName()}', {$this->getCourseNum()})");
					$this->id = $GLOBALS['DB']->lastInsertId();
			}

			static function getAll()
			{
					$returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
					$courses = array();
					foreach($returned_courses as $course) {
							$id = $course['id'];
							$course_name = $course['course_name'];
							$course_num = $course['course_num'];
							$new_course = new Course($id, $course_name, $course_num);
							array_push($courses, $new_course);
					}
					return $courses;
			}

			static function deleteAll()
			{
					$GLOBALS['DB']->exec("DELETE FROM courses;");
			}

		static function find($search_id)
		{
				$found_course = null;
				$courses = Course::getAll();
				foreach($courses as $course) {
						$course_id = $course->getId();
						if ($course_id == $search_id) {
								$found_course = $course;
						}
				}
				return $found_course;
		}

		function addStudent($student)
    {
        $GLOBALS['DB']->exec("INSERT INTO students_courses (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
    }

    function getStudents()
    {
      $query = $GLOBALS['DB']->query("SELECT student_id FROM students_courses WHERE course_id = {$this->getId()};");
      $student_ids = $query->fetchAll(PDO::FETCH_ASSOC);

      $students = array();
      foreach($student_ids as $id) {
          $student_id = $id['student_id'];
          $result = $GLOBALS['DB']->query("SELECT * FROM students WHERE id = {$student_id};");
          $returned_student = $result->fetchAll(PDO::FETCH_ASSOC);

          $name = $returned_student[0]['name'];
          $id = $returned_student[0]['id'];
          $add_date = $returned_student[0]['add_date'];
          $new_student = new Student($id, $name, $add_date);
          array_push($students, $new_student);
      }
      return $students;
    }

	}
 ?>
