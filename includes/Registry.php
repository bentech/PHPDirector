<?php

/**
 * Simple PHP 4 registry class that should be used to hold global
 * application data.
 *
 * The registry class is useful when functions need global information,
 * such as database or config information. They do not need to
 * encumber themselves by using global variables. Because this class
 * is written for PHP 4, it does not use some of the nice bounds
 * available in PHP 5, so programmers must take care to use this class
 * correctly. I don't know what this does to unit testing.
 *
 * Although unenforceable in PHP 4, Registry should be a singleton class,
 * and it should never return an instance of itself. Instead, the class
 * is needed only to ensure that a registry array exists, because class
 * variables do not exist in PHP 4.
 *
 * In order to conserve memory, the registry holds no copies of anything,
 * only references. This is most useful with large objects, but PHP 4
 * does not distinguish between scalars and objects, so scalars are also
 * treated as references in the registry. Therefore, extra care must be
 * taken when using the class.
 *
 * @author      Teddy Ni <zyloch@gmail.com>
 * @version     1.0
 */
class Registry {

    /**
     * @static
     * @access  private
     * @var     array   holds global data as an associative array
     */
    var $_registry;

    /**
     * @static
     * @access  private
     * @var     int     number of entries in the registry
     */
    var $_size;

    /**
     * Initializes the registry with an empty array.
     *
     * @access  private
     * @return  object  new empty Registry object
     */
    function Registry() {
        $this->_registry = array();
        $this->_size = 0;
    }

    /**
     * Enforces the singleton pattern and should be used to obtain
     * the registry object when needed. In PHP 4, it is necessary
     * to call with $registry = &Registry::getInstance(); even though
     * PHP 5 automatically returns objects by reference.
     *
     * @static
     * @access      public
     * @staticvar   object  holds the classwide Registry object
     * @return      array   the registry array
     */
    function &getInstance() {
        static $registry = null;

        if (null === $registry) {
            $registry = new Registry();
        }

        return $registry;
    }

    /**
     * Gets the registry entry with the given key.
     *
     * The value is returned by reference. This is necessary in PHP 4 for
     * objects, even though it isn't in PHP 5. Thus, changing the returned
     * variable will also change the value stored in the registry, whether
     * the value is a string, an int, or an object. Always call with
     * with $value = &Registry::get($key); to maintain consistent behavior
     * in PHP 4 and PHP 5.
     *
     * @static
     * @access  public
     * @param   string  the key to the desired registry entry
     * @return  mixed   the value of the desired registry entry
     */
    function &get($key) {
        $registry = &Registry::getInstance();
        return $registry->_registry[$key];
    }

    /**
     * Returns the registry array, with all its entries. It returns it by
     * reference, so any changes to the array values change the entries in
     * the registry as well.
     *
     * @static
     * @access  public
     * @return  array   the registry array
     */
    function &getAll() {
        $registry = &Registry::getInstance();
        return $registry->_registry;
    }

    /**
     * Sets the registry entry with the given key. If the key exists,
     * the new value overwrites the old value.
     *
     * The $value is passed by reference. This means that any subsequent
     * changes to the value after placing it in the registry will reflect
     * as a change in the registry. If you want to reuse a variable placed
     * in the registry to hold something else in your code, you need to
     * unset it first to break the binding between the two.
     *
     * @static
     * @access  public
     * @param   string  the key of the new registry entry
     * @param   &mixed  the value of the new registry entry
     */
    function set($key, &$value) {
        $registry = &Registry::getInstance();
        $registry->_registry[$key] = &$value;
        $registry->_size++;
    }

    /**
     * Returns true if the registry has an entry with the supplied key,
     * false if not.
     *
     * @static
     * @access  public
     * @param   string  the key of the registry entry
     * @return  boolean whether the registry contains the entry
     */
    function has($key) {
        $registry = &Registry::getInstance();
        return isset($registry->_registry[$key]);
    }

    /**
     * Returns the number of entries in the registry.
     *
     * @static
     * @access  public
     * @return  int     number of registry entries
     */
    function size() {
        $registry = &Registry::getInstance();
        return $registry->_size;
    }

    /**
     * Removes the entry with the given key from the registry.
     *
     * @static
     * @access  public
     * @param   string  the key of the registry entry
     */
    function remove($key) {
        $registry = &Registry::getInstance();
        unset($registry->_registry[$key]);
    }
}

?>