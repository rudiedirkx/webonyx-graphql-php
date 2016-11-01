<?php
namespace GraphQL\Type;

use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\ObjectType;

class TypeResolver {

    public static $types = [];

    /**
     * Resolve a type from a class name, or pass it through
     */
    public static function resolveType($type)
    {
        if (is_object($type)) {
            if (!in_array(get_class($type), [ObjectType::class, InterfaceType::class])) {
                self::$types[get_class($type)] = $type;
            }

            return $type;
        }

        if (is_string($type)) {
            if (!isset(self::$types[$type])) {
                self::$types[$type] = new $type;
            }

            return self::$types[$type];
        }

        return $type;
    }

}
