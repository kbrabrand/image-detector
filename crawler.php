<?php

if (count($argv) < 4) {
    echo 'Usage: php crawler.php destination volume fromPage toPage' . PHP_EOL;
    die;
}

$destination = $argv[1];
$volume = $argv[2];
$fromPage = $argv[3];
$toPage = $argv[4];
$level = 6;
$rowTiles = 3;
$colTiles = 2;

if ($volume > 4) {
    echo 'Volume out of bounds. Allowed values: 1-4' . PHP_EOL;
    die;
}

$volumeUrns = [
    1 => 'URN:NBN:no-nb_digibok_2007020801077',
    2 => 'URN:NBN:no-nb_digibok_2007020801076',
    3 => 'URN:NBN:no-nb_digibok_2007020500018',
    4 => 'URN:NBN:no-nb_digibok_2008042900069',
];

for ($page=$fromPage; $page<=$toPage; $page++) {
    $pageString = str_pad($page, 4, "0", STR_PAD_LEFT);

    $pageDir = $destination . DIRECTORY_SEPARATOR . $pageString;

    if (substr($pageDir, 0, 1) !== '/') {
        $pageDir = getcwd() . DIRECTORY_SEPARATOR . $pageDir;
    }

    if (!is_dir($pageDir)) {
        mkdir($pageDir);
    }

    $successfulTiles = 0;

    for ($row=0; $row<=$rowTiles; $row++) {
        for ($col=0; $col<=$colTiles; $col++) {
            $tileUrl = sprintf(
                'http://www.nb.no/services/image/resolver?url_ver=geneza&urn=%s_%s&maxLevel=6&level=%d&col=%d&row=%d&resX=2808&resY=3984&tileWidth=1024&tileHeight=1024&pg_id=%s',
                $volumeUrns[$volume],
                $pageString,
                $level,
                $col,
                $row,
                $page
            );

            $tileFile = sprintf(
                '%s' . DIRECTORY_SEPARATOR . '%s-%s.jpg',
                $pageDir,
                $row,
                $col
            );

            $bytes = file_put_contents($tileFile, fopen($tileUrl, 'r'));
            chmod($tileFile, 0777);

            if (!!$bytes) {
                $successfulTiles++;
            }
        }
    }

    if ($successfulTiles !== 12) {
        echo sprintf('! Only %d of expected 12 tiles for vol. %d, page %d was downloaded.', $successfulTiles, $volume, $page) . PHP_EOL;
        continue;
    }

    $stitchedPath = $destination . DIRECTORY_SEPARATOR . $pageString . '.jpg';

    exec('python stitcher.py ' . $pageDir . ' ' . $stitchedPath);

    if (is_file($stitchedPath)) {
        exec('rm -rf ' . $pageDir);
    }

    echo sprintf('Downloaded volume %d, page %d', $volume, $page) . PHP_EOL;
}
