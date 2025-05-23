<?php
//コマンドライン引数を$filenameに格納
$origin_filename = $argv[1];
if (!file_exists($origin_filename)) {
    echo "ファイルが存在しません\n";
    exit;
}

$metadata = shell_exec("pdftk $origin_filename dump_data");
$lines = explode("\n", $metadata);

$update_metadata = '';
foreach ($lines as $key => $line) {
    if (isset($lines[$key - 1]) && preg_match('/^InfoKey: (Keywords|Subject|Author|Title)$/', $lines[$key - 1])) {
        $update_metadata .= 'InfoValue:' . "\n";
        continue;
    } else {
        $update_metadata .= $lines[$key] . "\n";
    }
}

$script_dir = __DIR__;
file_put_contents("$script_dir/tmp.txt", $update_metadata);
$new_file = "$script_dir/Output/" . $argv[2];
shell_exec("pdftk $origin_filename update_info $script_dir/tmp.txt output $new_file");
unlink("$script_dir/tmp.txt");
shell_exec("open $script_dir/Output/");
