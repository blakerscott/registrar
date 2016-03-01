<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";
    require_once "src/Student.php";

    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
        }

        function test_getCourseName()
        {
            $course_name = "Economics";
            $id = 1;
            $course_num = 101;
            $test_course = new Course($id, $course_name, $course_num);

            $result = $test_course->getCourseName();

            $this->assertEquals($course_name, $result);
        }

        function test_getId()
        {
            $course_name = "Economics";
            $id = 1;
            $course_num = 101;
            $test_course = new Course($id, $course_name, $course_num);

            $result = $test_course->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            $course_name = "Economics";
            $course_num = 101;
            $id = 1;
            $test_course = new Course($id, $course_name, $course_num);
            $test_course->save();

            $result = Course::getAll();

            $this->assertEquals($test_course, $result[0]);
        }

        function test_getAll()
        {
            $course_name = "Economics";
            $course_num = 101;
            $id = 1;
            $course_name2 = "Math";
            $course_num2 = 95;
            $id2 = 2;
            $test_course = new Course($id, $course_name, $course_num);
            $test_course->save();
            $test_course2 = new Course($id2, $course_name2, $course_num2);
            $test_course2->save();

            $result = Course::getAll();

            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function test_deleteAll()
        {
            $course_name = "Economics";
            $course_num = 101;
            $id = 1;
            $course_name2 = "Math";
            $course_num2 = 95;
            $id = 2;
            $test_course = new Course($id, $course_name, $course_num);
            $test_course->save();
            $test_course2 = new Course($id, $course_name2, $course_num2);
            $test_course2->save();

            Course::deleteAll();
            $result = Course::getAll();

            $this->assertEquals ([], $result);
        }

        function test_find()
        {
            $course_name = "Economics";
            $course_num = 101;
            $id = 1;
            $course_name2 = "Math";
            $course_num2 = 95;
            $id = 2;
            $test_course = new Course($id, $course_name, $course_num);
            $test_course->save();
            $test_course2 = new Course($id, $course_name2, $course_num2);
            $test_course2->save();

            $result = Course::find($test_course->getId());

            $this->assertEquals($test_course, $result);
        }


    }

?>
