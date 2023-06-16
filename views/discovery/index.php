<?php

/** @var yii\web\View $this */
?>
<style>
    #devices,
    #devices td {
        border: 1px solid;
        padding: 10px;
    }

    .th,
    .th td {
        font-weight: bold;
    }
</style>
<h1>Network discovery</h1>

<p>
    You must enter an ip to discover the network.<br>
    <code>you can add '/24' to the end of ip address for scanning ip range</code>
</p>
<form action="/index.php?r=discovery%2Findex" method="POST">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
    <div class="row">
        <div class="col-lg-8 col-md-10">
            <div class="module-form">
                <div class="form-group required">
                    <label class="control-label">IP for scan</label>
                    <input type="text" id="ip" class="form-control" name="ip">
                </div>
            </div>
            <?php
            if (isset($error) and $error) {
                echo '<code>' . $error . '</code><br><br>';
            }
            ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="scan">scan</button>
            </div>
        </div>
    </div>

</form>

<h2>Last scan</h2>
<table id="devices">
    <tr class="th">
        <td>ip</td>
        <td>name</td>
        <td>mac</td>
        <td>open ports</td>
    </tr>
    <?php
    foreach ($devices as $device) {
    ?>
        <tr>
            <td><?= $device['ip'] ?></td>
            <td><?= $device['name'] ?></td>
            <td><?= $device['mac'] ?></td>
            <td><?= $device['ports'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>