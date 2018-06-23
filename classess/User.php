<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

	class User{
		private $db;
		private $fm;

		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function userRegistration($name, $username, $email, $password) {
			$name     = $this->fm->validation($name);
			$username = $this->fm->validation($username);
			$email    = $this->fm->validation($email);
			$password = $this->fm->validation($password);

			$name = mysqli_real_escape_string($this->db->link, $name);
			
			$username = mysqli_real_escape_string($this->db->link, $username);
			$email = mysqli_real_escape_string($this->db->link, $email);
			$password = mysqli_real_escape_string($this->db->link, md5($password));
			if ($name == "" || $username == "" || $email == "" || $password == "") {
				return "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-warning-sign'></span> Field must not be empty.</div>";
				exit();
			} else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				return "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-warning-sign'></span> Invalid email address.</div>";
				exit();
			} else {
				$chkquery = "SELECT * FROM tbl_users WHERE email = '$email';";
				$chkresult = $this->db->select($chkquery);
				if ($chkresult) {
					return "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-warning-sign'></span> Email address already exist.</div>";
					exit();
				} else {
					$query = "INSERT INTO tbl_users(name, username, email, password) VALUES('$name', '$username', '$email', '$password')";
					$insert_row = $this->db->insert($query);
					if ($insert_row) {
						return "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-ok'></span> You are successfully Registered.</div>";
						exit();
					} else {
						return "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-warning-sign'></span> Oops! Something is going wrong.</div>";
						exit();
					}
				}

			}
		}

		public function userLogin($email, $password) {
			$email    = $this->fm->validation($email);
			$password = $this->fm->validation($password);

			$email = mysqli_real_escape_string($this->db->link, $email);
			$password = mysqli_real_escape_string($this->db->link, md5($password));
			if ($email == "" || $password == "") {
				return "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-warning-sign'></span> Field must not be empty.</div>";
				exit();
			} else {
				$query  = "SELECT * FROM tbl_users WHERE email='$email' AND password='$password'";
				$result = $this->db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					if ($value['status'] == '1') {
						return "<div class='alert alert-warning alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-warning-sign'></span> You are disabled by admin.</div>";
						exit();
					} else {
						 Session::init();
						 Session::set("login", true);
						 Session::set("userId", $value['userId']);
						 Session::set("name", $value['name']);
						 Session::set("username", $value['username']);
						 header("location: exam.php");
					}
				} else {
					return "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-warning-sign'></span> Email or Password Not Matched.</div>";
					exit();
				}
			}
		}

		public function getUserData($userId) {
			$query  = "SELECT * FROM tbl_users WHERE userId='$userId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllUser() {
			$query  = "SELECT * FROM tbl_users ORDER BY userId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateUserData($userId, $data) {
			$name     = $this->fm->validation($data['name']);
			$username = $this->fm->validation($data['username']);
			$email    = $this->fm->validation($data['email']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			
			$username = mysqli_real_escape_string($this->db->link, $username);
			$email = mysqli_real_escape_string($this->db->link, $email);

			$query = "UPDATE tbl_users 
						SET name = '$name',
							username = '$username',
							email = '$email'
						 WHERE userId = '$userId'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-ok'></span> User Data Updated Successfully.</div>";
				return $msg;
			} else {
				$msg = "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span class='glyphicon glyphicon-warning-sign'></span> Oop! Something is going wrong.</div>";
				return $msg;
			}
		}

		public function disableUser($userId) {
			$query = "UPDATE tbl_users SET status = '1' WHERE userId = '$userId'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "<span class='success'>User Disabled !</span>";
				return $msg;
			} else {
				$msg = "<span class='error'>User Not Disabled !</span>";
				return $msg;
			}
		}

		public function enableUser($userId) {
			$query = "UPDATE tbl_users SET status = '0' WHERE userId = '$userId'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "<span class='success'>User Enabled !</span>";
				return $msg;
			} else {
				$msg = "<span class='error'>User Not Enabled !</span>";
				return $msg;
			}
		}

		public function deleteUser($userId) {
			$query = "DELETE FROM tbl_users WHERE userId = '$userId'";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<span class='success'>User Removed !</span>";
				return $msg;
			} else {
				$msg = "<span class='error'>User Not Removed !</span>";
				return $msg;
			}
		}
	}
 ?>