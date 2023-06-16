<?php

namespace app\controllers;

use Nmap\Nmap;
use app\models\Devices;
use yii;

class DiscoveryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if ($_POST) {
            try {
                $hosts = Nmap::create()->scan([Yii::$app->request->post()['ip']]);
            } catch (\Exception $ex) {
                return $this->render('index', ['devices' => [], 'error' => 'ip or network is not reachable or may be scanning timeout reached!']);
            }

            if (!$hosts) {
                $devices = $this->getLastScan();
                return $this->render('index', ['devices' => $devices, 'error' => 'ip or network is not reachable!']);
            }
            $devices = [];
            $ports = [];
            $i = 0;
            foreach ($hosts as $host) {
                $devices[$i]['ip'] = json_encode(array_keys($host->getIpv4Addresses()));
                $devices[$i]['name'] = json_encode(array_keys($host->getHostnames()));
                $devices[$i]['mac'] = json_encode(array_keys($host->getMacAddresses()));
                foreach ($host->getOpenPorts() as $port) {
                    $ports[] = $port->getNumber();
                }
                $devices[$i]['ports'] = implode(',', $ports);
                $i++;
            }

            $lastScan = Devices::find()->max('scan_series');
            $scanSeries = $lastScan + 1;

            foreach ($devices as $device) {
                $devicesModel = new Devices();
                $devicesModel->ip = $device['ip'];
                $devicesModel->name = $device['name'];
                $devicesModel->mac = $device['mac'];
                $devicesModel->ports = $device['ports'];
                $devicesModel->scan_series =  $scanSeries;
                $devicesModel->create_at = date('Y-m-d H-i-s');
                $devicesModel->save();
            }
        } else {
            $devices = $this->getLastScan();
        }

        return $this->render('index', ['devices' => $devices]);
    }

    public function getLastScan()
    {
        $lastScan = Devices::find()
            ->max('scan_series');
        return Devices::find()
            ->where(['scan_series' => $lastScan])
            ->all();
    }
}
