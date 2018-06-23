<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

	class Exam{
		private $db;
		private $fm;

		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function addQuestion($data) {
			$quesNo = mysqli_real_escape_string($this->db->link, $data['quesNo']);
			$ques   = mysqli_real_escape_string($this->db->link, $data['ques']);
			$ans    = array();
			$ans[1] = $data['ans1'];
			$ans[2] = $data['ans2'];
			$ans[3] = $data['ans3'];
			$ans[4] = $data['ans4'];
			$rightAns = $data['rightAns'];

			$query = "INSERT INTO tbl_ques(quesNo, ques) VALUES('$quesNo', '$ques')";
			$insert_row = $this->db->insert($query);
			if ($insert_row) {
				foreach ($ans as $key => $ansName) {
					if ($ans != "") {
						if ($rightAns == $key) {
							$rquery = "INSERT INTO tbl_ans(quesNo, rightAns, ans) VALUES('$quesNo', '1', '$ansName')";
						} else {
							$rquery = "INSERT INTO tbl_ans(quesNo, rightAns, ans) VALUES('$quesNo', '0', '$ansName')";
						}
						$insertrow = $this->db->insert($rquery);
						if ($insertrow) {
							continue;
						} else {
							die("Oops! Something is wrong.");
						}
					}
				}
			}
			$msg = "<span class='success'>Question Added Successfully.</span>";
			return $msg;
		}

		public function getQuesByOrder() {
			$query = "SELECT * FROM tbl_ques ORDER BY quesNo DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function delQuestion($quesNo) {
			$tables = array("tbl_ques", "tbl_ans");
			foreach ($tables as $table) {
				$delQuery = "DELETE FROM $table WHERE quesNo = '$quesNo'";
				$delData  = $this->db->delete($delQuery);
			}
			if ($delData) {
				$msg = "<span class='success'>Question Removed !</span>";
				return $msg;
			} else {
				$msg = "<span class='error'>Question Not Removed !</span>";
				return $msg;
			}
		}

		public function getTotalRows() {
			$query     = "SELECT * FROM tbl_ques";
			$getResult = $this->db->select($query);
			$total     = $getResult->num_rows; 
			return $total;
		}

		public function getQueation() {
			$query   = "SELECT * FROM tbl_ques";
			$getQues = $this->db->select($query);
			$result  = $getQues->fetch_assoc();
			return $result;
		}

		public function getQuestionByNumber($number) {
			$query   = "SELECT * FROM tbl_ques WHERE quesNo = '$number'";
			$getQuesNumber = $this->db->select($query);
			$result  = $getQuesNumber->fetch_assoc();
			return $result;
		}

		public function getAnswer($number) {
			$query   = "SELECT * FROM tbl_ans WHERE quesNo = '$number'";
			$getAns = $this->db->select($query);
			return $getAns;
		}
	}
 ?>