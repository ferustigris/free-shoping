<?php
include_once "include/iface.module.php";
//! class for Messages
class FAQ {
	private $module;//! parent module
	private $id;//! template id
	/*! constructor
	 * \params
	 * - parent - parent module
	 * - id - root id
	 * \return no
	 */
	public function __construct(&$parent, $id)
	{
		$this->module = $parent;
		$this->id = intval($id);
	}
	/*! all
	 * \params no
	 * \return text
	 */
	public function all()
	{
		$r = Array();
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id
				FROM
				".$db->getPrefix()."faq;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$r[] = new FAQ($this->module, $line[0]);
				}
			}
		}
		return $r;
	}
	/*! answer
	 * \params no
	 * \return text
	 */
	public function answer()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_answer
				FROM
				".$db->getPrefix()."faq
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return urldecode($line[0]);
				}
			}
		}
		return NULL;
	}
	/*! question
	 * \params no
	 * \return text
	 */
	public function question()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_question
				FROM
				".$db->getPrefix()."faq
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return urldecode($line[0]);
				}
			}
		}
		return NULL;
	}
	/*! add new messages
	 * \params
	 * - $question - question
	 * - $answer - answer
	 * \return true/false
	 */
	public function add($question, $answer)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."faq(s_question, s_answer)
				VALUES( '".$question."', '".$answer."');"))
			{
				return true;
			}
		}
		return false;
	}
}
?>
