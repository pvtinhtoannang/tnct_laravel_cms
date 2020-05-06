<?php
/**
 * User: NFSociety
 * Date: 27/04/2020
 * Time: 3:37 CH
 */

class Action_hooks
{
    public static $hooks_instance;

    public static $actions;

    public static $current_action;

    public static $run_actions;

    public static function instance()
    {
        if (!self::$hooks_instance) {
            self::$hooks_instance = new Action_hooks();
        }

        return self::$hooks_instance;
    }

    public function add_action($name, $function, $priority = 10)
    {
        if (is_string($function)) {
            // If we have already registered this action return true
            if (isset(self::$actions[$name][$priority][$function])) {
                return true;
            }
        } elseif (is_array($function)) {
            // Class
            if (isset(self::$actions[$name][$priority][get_class($function[0]) . '-' . $function[1]])) {
                return true;
            }
        }
        /**
         * Allows us to iterate through multiple action hooks.
         */
        if (is_array($name)) {
            foreach ($name as $name) {
                // Store the action hook in the $hooks array
                if (is_string($function)) {
                    // Store the action hook in the $hooks array
                    self::$actions[$name][$priority][$function] = [
                        'function' => $function,
                    ];
                } elseif (is_array($function)) {
                    self::$actions[$name][$priority][get_class($function[0]) . '-' . $function[1]] = [
                        'class' => $function[0],
                        'method' => $function[1],
                    ];
                }
            }
        } else {
            if (is_string($function)) {
                // Store the action hook in the $hooks array
                self::$actions[$name][$priority][$function] = [
                    'function' => $function,
                ];
            } elseif (is_array($function)) {
                self::$actions[$name][$priority][get_class($function[0]) . '-' . $function[1]] = [
                    'class' => $function[0],
                    'method' => $function[1],
                ];
            }
        }

        return true;
    }

    /**
     * Do Action
     *
     * Trigger an action for a particular action hook
     *
     * @param mixed $name
     * @param mixed $arguments
     * @return mixed
     */
    public function do_action($name, $arguments = '')
    {
        // Oh, no you didn't. Are you trying to run an action hook that doesn't exist?
        if (!isset(self::$actions[$name])) {
            return $arguments;
        }

        // Set the current running hook to this
        self::$current_action = $name;
        // Key sort our action hooks
        ksort(self::$actions[$name]);
        foreach (self::$actions[$name] as $priority => $names) {
            if (is_array($names)) {
                foreach ($names as $name) {
                    if (isset($name['function'])) {
                        $return = call_user_func_array($name['function'], [
                            &$arguments,
                        ]);
                        if ($return) {
                            $arguments = $return;
                        }
                        self::$run_actions[$name][$priority];
                    } else {
                        if (method_exists($name['class'], $name['method'])) {
                            $return = call_user_func_array([$name['class'], $name['method']], [
                                &$arguments,
                            ]);

                            if ($return) {
                                $arguments = $return;
                            }

                            self::$run_actions[get_class($name['class']) . '-' . $name['method']][$priority];
                        }
                    }
                }
            }
        }
        self::$current_action = '';

        return $arguments;
    }

    public function remove_action($name, $function, $priority = 10)
    {
        if (!is_array($function)) {
            // If the action hook doesn't, just return true
            if (!isset(self::$actions[$name][$priority][$function])) {
                return true;
            }
            // Remove the action hook from our hooks array
            unset(self::$actions[$name][$priority][$function]);
        } elseif (is_array($function)) {
            if (!isset(self::$actions[$name][$priority][$function[0] . '-' . $function[1]])) {
                return true;
            }
            // Remove the action hook from our hooks array
            unset(self::$actions[$name][$priority][$function[0] . '-' . $function[1]]);
        }
    }


    public function current_action()
    {
        return self::$current_action;
    }

    public function has_run($action, $priority = 10)
    {
        if (isset(self::$actions[$action][$priority])) {
            return true;
        }

        return false;
    }


    public function action_exists($name)
    {
        if (isset(self::$actions[$name])) {
            return true;
        }

        return false;
    }
}

function add_action($name, $function, $priority = 10)
{
    return Action_hooks::instance()->add_action($name, $function, $priority);
}


function do_action($name, $arguments = '')
{
    return Action_hooks::instance()->do_action($name, $arguments);
}


function remove_action($name, $function, $priority = 10)
{
    return Action_hooks::instance()->remove_action($name, $function, $priority);
}

function action_exists($name)
{
    return Action_hooks::instance()->action_exists($name);
}
