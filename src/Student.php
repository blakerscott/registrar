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



	}
 ?>
