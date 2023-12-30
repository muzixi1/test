<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>显示和复制内容</title>
    <style>
        .content {
            margin-bottom: 10px;
        }
        .copy-button img {
            width: 16px; /* 设置图标宽度 */
            height: 16px; /* 设置图标高度 */
            vertical-align: middle;
            margin-right: 5px; /* 设置图标与文本的右边距 */
        }
    </style>
    <meta http-equiv="refresh" content="5">
</head>
<body>

<?php
// 读取文件内容
$fileContent = file_get_contents('a.txt');

// 将每行拆分成数组
$lines = explode("<br>", $fileContent);

// 倒序排列数组
$lines = array_reverse($lines);

// 遍历每行
foreach ($lines as $line) {
    // 解析每行的内容
    preg_match('/<strong>(.*?)<\/strong> (.*?) \((.*?)\)/', $line, $matches);

    if (count($matches) === 4) {
        // 提取用户名、内容和时间
        $username = $matches[1];
        $content = $matches[2];
        $timestamp = $matches[3];

        // 显示内容
        echo '<div class="content">';
        echo '<strong>' . $username . ':</strong> ' . $content . ' (' . $timestamp . ')';
        echo '<button class="copy-button" onclick="copyToClipboard(\'' . $content . '\')">';
        echo '<img src="a.png" alt="复制图标"> 复制';
        echo '</button>';
        echo '</div>';
    }
}
?>

<script>
    function copyToClipboard(text) {
        var textField = document.createElement('textarea');
        textField.innerText = text;
        document.body.appendChild(textField);
        textField.select();
        document.execCommand('copy');
        textField.remove();
        alert('已复制到剪贴板: ' + text);
    }
</script>

</body>
</html>
