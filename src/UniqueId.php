<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2018/11/7
 * Time: 上午11:43
 */

namespace CollinPeng;

use CollinPeng\UniqueId\MACAddress;

class UniqueId
{
    /**
     * return the object id str
     * https://docs.mongodb.com/manual/reference/method/ObjectId/
     *
     * @return string
     */
    public function objectId()
    {
        $seconds = dechex(time());
        $machin = substr(hash("crc32", MACAddress::getCurrentMACAddress()), 2);
        $pid = $this->getPid();
        $rand = dechex(rand(1048576, 16777215));

        return substr($seconds . $machin . $pid . $rand, 0, 24);
    }

    /**
     * return a uuid
     *
     * @return string
     */
    public function uuid()
    {
        return sprintf("%s-%04x-%04x-%04x-%04x%04x%04x",
            dechex(time()),  mt_rand(0, 0xffff),
            mt_rand(0, 0xffff), mt_rand(0, 0xffff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * return 4 byte pid
     *
     * @return string
     */
    private function getPid()
    {
        $pid = dechex(getmypid());

        if (strlen($pid) > 4) {
            $pid = substr($pid, strlen($pid) - 4, 4);
        }

        if (strlen($pid) < 4) {
            $pid = str_repeat("0", 4 - strlen($pid)) . $pid;
        }

        return $pid . "";
    }
}