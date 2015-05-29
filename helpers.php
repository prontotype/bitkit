<?php
 
use Amu\Sup\Arr;
use Amu\Sup\Debug;
use Amu\Sup\Path;
use Amu\Sup\Str;
use Amu\Sup\Template;
use Amu\Sup\Url;

// Path helpers ----------------------------------------------------------------------

if ( ! function_exists('path_join'))
{
    /**
     * Join the arguments list into a path.
     *
     * @return string
     */
    function path_join()
    {
        return call_user_func_array('Amu\Sup\Path::join', func_get_args());
    }
}

if ( ! function_exists('path'))
{
    /**
     * Expand tildes and normalize dot segments in a path.
     *
     * @return string
     */
    function path()
    {
        return Path::normalize(call_user_func_array('path_join', func_get_args()));
    }
}

if ( ! function_exists('infile_exists'))
{
    /**
     * Case insensitive file_exists
     *
     * @return string
     */
    function infile_exists($fileName)
    {
        if($result = file_exists($fileName)) {
            return $result;
        }
        // Handle case insensitive requests            
        $directoryName = dirname($fileName);
        $fileArray = glob($directoryName . '/*', GLOB_NOSORT);
        $fileNameLowerCase = strtolower($fileName);
        foreach($fileArray as $file) {
            if(strtolower($file) == $fileNameLowerCase) {
                return true;
            }
        }
        return false;
    }
}


// String helpers ---------------------------------------------------------------------

if ( ! function_exists('s'))
{
    /**
     * Turn a string into a slug
     *
     * @return string
     */
    function s()
    {
        return call_user_func_array('sprintf', func_get_args());
    }
}

if ( ! function_exists('slugify'))
{
    /**
     * Turn a string into a slug
     *
     * @return string
     */
    function slugify($str)
    {
        return Str::slugify($str);
    }
}

if ( ! function_exists('starts_with'))
{
    /**
     * Turn a string into a slug
     *
     * @return string
     */
    function starts_with($str, $subStr, $caseSensitive = true)
    {
        return Str::startsWith($str, $subStr, $caseSensitive);
    }
}



// Array helpers ---------------------------------------------------------------------

if ( ! function_exists('deep_merge'))
{
    /**
     * Perform a recursive deep merge on two arrays
     *
     * @return string
     */
    function deep_merge(array &$array1, array &$array2)
    {
        return Arr::deepMerge($array1, $array2);
    }
}

if ( ! function_exists('array_get'))
{
    /**
     * Get an item from an array using "dot" notation.
     *
     * @return string
     */
    function array_get($array, $key, $default = null)
    {
        return Arr::get($array, $key, $default);
    }
}

if ( ! function_exists('array_first'))
{
    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param array    $array
     * @param callable $callback
     * @param mixed    $default
     *
     * @return mixed
     */
    function array_first($array, callable $callback, $default = null)
    {
        return Arr::first($array, $callback, $default);
    }
}

// Other helpers ----------------------------------------------------------------------

if ( ! function_exists('template'))
{
    /**
     * Render a simple PHP template
     *
     * @param string $path
     * @param array  $args
     *
     * @return string
     */
    function template($path, $args = [])
    {
        return Template::render($path, $args);
    }
}
