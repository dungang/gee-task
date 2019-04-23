<?php
namespace app\helpers;

use yii\helpers\FileHelper;
use yii\helpers\Json;

/**
 *
 * @author dungang
 */
class CrontabHelpers
{

    const CRON_STATUS_NAME = 'crontab.status';

    const CRON_TRACED_AT_NAME = 'crontab.traced_at';

    const CRON_DATA_FILE_BASE = '@runtime/cron/';

    private static function getCronDataFile($cron_name = 'data')
    {
        return self::CRON_DATA_FILE_BASE . $cron_name . '.txt';
    }

    private static function readCron($cron_name = 'data')
    {
        $file = \Yii::getAlias(self::getCronDataFile($cron_name));
        if (! \is_file($file)) {
            $dir = \dirname($file);
            if (! \is_dir($dir)) {
                FileHelper::createDirectory($dir);
            }
            \file_put_contents($file, Json::encode([
                self::CRON_STATUS_NAME => 0,
                self::CRON_TRACED_AT_NAME => 0
            ]));
        }
        if ($data = \file_get_contents($file)) {
            return Json::decode($data);
        }
        return [
            self::CRON_STATUS_NAME => 0,
            self::CRON_TRACED_AT_NAME => 0
        ];
    }

    private static function writeCron($data, $cron_name = 'data')
    {
        $raw = self::readCron();
        $file = \Yii::getAlias(self::getCronDataFile($cron_name));
        \file_put_contents($file, Json::encode(\array_merge($raw, $data)));
    }

    public static function prepareCronSetting($cron_name = 'data')
    {
        $data = self::readCron($cron_name);

        return [
            $data[self::CRON_STATUS_NAME],
            $data[self::CRON_TRACED_AT_NAME]
        ];
    }

    public static function getCronStatus($cron_name = 'data')
    {
        return self::readCron($cron_name)[self::CRON_STATUS_NAME];
    }

    public static function activeCronStatus($cron_name = 'data')
    {
        self::writeCron([
            self::CRON_STATUS_NAME => time()
        ], $cron_name);
    }

    public static function unactiveCronStatus($cron_name = 'data')
    {
        self::writeCron([
            self::CRON_STATUS_NAME => 0
        ], $cron_name);
    }

    public static function tracedCron($cron_name = 'data')
    {
        self::writeCron([
            self::CRON_TRACED_AT_NAME => time()
        ], $cron_name);
    }
}

