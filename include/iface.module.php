<?php
//! class for modules
abstract class Module {
	/*! access to cookies
	 * \params no
	 * \return no
	 */
	abstract public function cookies();
	/*! access to sessions
	 * \params no
	 * \return no
	 */
	abstract public function sessions();
	/*! access to db
	 * \params no
	 * \return no
	 */
	abstract public function db();
	/*! add msg to log
	 * \params
	 * - level - log level
	 * - msg - log msg
	 * \return no
	 */
	abstract public function log($level, $msg);
	/*! access to variables
	 * \params
	 * - var_name - name
	 * \return no
	 */
	abstract public function get_var($var_name);
	/*! access to variables
	 * \params
	 * - var_name - name
	 * - var_value - value
	 * \return no
	 */
	abstract public function set_var($var_name, $var_value);
	/*! access to db options
	 * \params no
	 * \return no
	 */
	abstract public function db_options();
	/*! access to concrete other module
	 * \params
         * - module_name - module name
	 * \return no
	 */
	abstract public function get_module($module_name);
	/*! access to data of GET-forms
	 * \params no
	 * \return no
	 */
	abstract public function forms_get();
		/*! access to data of POST-forms
	 * \params no
	 * \return no
	 */
	abstract public function forms_post();
	/*! translate
	 * \params
	 * - source - source text
	 * \return translated text
	 */
	abstract public function translate($source);
	/*! get module name
	 * \params no
	 * \return no
	 */
	abstract public function name();
}
?>
