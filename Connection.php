<?php

class Connection{

	public $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=ctg-323","root","");
	}

	// get all notes
	public function getAllnotes($user_id)
	{
		$statement = $this->conn->prepare("SELECT * FROM tasks WHERE user_id= '$user_id'");
		$statement->execute();
		$data = $statement->fetchAll();
		return $data;	
	}

	// get a note
	public function getNote($id)
	{
		$statement = $this->conn->prepare("SELECT * FROM tasks WHERE id=$id;");
		$statement->execute();
		$data = $statement->fetchAll();
		return $data;
	}

	// update a note
	public function update($title,$details,$day,$id)
	{
		$title = addslashes($title);
		$statement = $this->conn->prepare("UPDATE tasks SET title='$title',details='$details',day='$day' WHERE id=$id;");
		$statement->execute();
	}

	//delete a note
	public function delete($id)
	{
		$statement = $this->conn->prepare("DELETE FROM tasks WHERE id=$id;");
		$statement->execute();
	}

	// insert a task
	public function addNote($title,$details,$day,$user_id,$img)
	{
		$statement = $this->conn->prepare("INSERT INTO tasks (title,details,day,image,status,user_id) VALUES (:title,:details,:day,:image,:status,:user_id);");
				$statement->execute(
					array(
						':title' => $title,
						':details' => $details,
						':day' => $day,
						':image'=> $img,
						':status' => 1,
						':user_id'	=> $user_id	
					)
				);

	}

	public function insert($query,$array)
	{
		$statement = $this->conn->prepare($query);
		$statement->execute($array);
	}

	public function fetch($query,$array)
	{
		$statement = $this->conn->prepare($query);
		$statement->execute($array);
		$data = $statement->fetchAll();
		return $data;
	}

}

?>
