<?php
/**
 * THttpSession class
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://github.com/pradosoft/prado
 * @copyright Copyright &copy; 2005-2016 The PRADO Group
 * @license https://github.com/pradosoft/prado/blob/master/LICENSE
 * @package Prado\Web
 */

namespace Prado\Web;

/**
 * TSessionIterator class
 *
 * TSessionIterator implements \Iterator interface.
 *
 * TSessionIterator is used by THttpSession. It allows THttpSession to return a new iterator
 * for traversing the session variables.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package Prado\Web
 * @since 3.0
 */
class TSessionIterator implements \Iterator
{
	/**
	 * @var array list of keys in the map
	 */
	private $_keys;
	/**
	 * @var mixed current key
	 */
	private $_key;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->_keys = array_keys($_SESSION);
	}

	/**
	 * Rewinds internal array pointer.
	 * This method is required by the interface Iterator.
	 */
	public function rewind()
	{
		$this->_key = reset($this->_keys);
	}

	/**
	 * Returns the key of the current array element.
	 * This method is required by the interface Iterator.
	 * @return mixed the key of the current array element
	 */
	public function key()
	{
		return $this->_key;
	}

	/**
	 * Returns the current array element.
	 * This method is required by the interface Iterator.
	 * @return mixed the current array element
	 */
	public function current()
	{
		return isset($_SESSION[$this->_key]) ? $_SESSION[$this->_key] : null;
	}

	/**
	 * Moves the internal pointer to the next array element.
	 * This method is required by the interface Iterator.
	 */
	public function next()
	{
		do {
			$this->_key = next($this->_keys);
		} while (!isset($_SESSION[$this->_key]) && $this->_key !== false);
	}

	/**
	 * Returns whether there is an element at current position.
	 * This method is required by the interface Iterator.
	 * @return bool
	 */
	public function valid()
	{
		return $this->_key !== false;
	}
}
