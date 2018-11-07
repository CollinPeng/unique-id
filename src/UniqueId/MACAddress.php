<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2018/11/7
 * Time: 下午1:22
 */


namespace CollinPeng\UniqueId;

class MACAddress
{
    /**
     * Regular expression for matching and validating a MAC address.
     *
     * @var string
     */
    private static $valid_mac = "([0-9A-F]{2}[:-]){5}([0-9A-F]{2})";

    /**
     * An array of valid MAC address characters
     *
     * @var array
     */
    private static $mac_address_vals = [
        '0', '1', '2', '3', '4', '5', '6', '7',
        '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'
    ];

    /**
     * Run the specified command and return it's output
     *
     * @param string $command
     * @return string Output from command that was run
     */
    protected static function runCommand($command)
    {
        return shell_exec($command);
    }

    /**
     * @return string generated MAC address
     */
    protected static function generateMACAddress()
    {
        $vals = self::$mac_address_vals;

        $mac = ['00'];
        while(count($mac) < 6) {
            shuffle($vals);
            $mac[] = $vals[0] . $vals[1];
        }

        $mac = implode(':', $mac);

        return $mac;
    }

    /**
     * Get the system's current MAC address
     * If it is not obtained, one is generated randomly
     *
     * @return string
     */
    public static function getCurrentMACAddress()
    {
        $ifconfig = null;
        if (PHP_OS == "Windows") {
            $ifconfig = self::runCommand("ipconfig /all");
        } else {
            $ifconfig = self::runCommand("ifconfig");
        }

        preg_match("/" . self::$valid_mac . "/i", $ifconfig, $ifconfig);
        if (isset($ifconfig[0])) {
            return trim(strtoupper($ifconfig[0]));
        }

        return self::generateMACAddress();
    }


}