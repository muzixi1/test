<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>��ʾ�͸�������</title>
    <style>
        .content {
            margin-bottom: 10px;
        }
        .copy-button img {
            width: 16px; /* ����ͼ���� */
            height: 16px; /* ����ͼ��߶� */
            vertical-align: middle;
            margin-right: 5px; /* ����ͼ�����ı����ұ߾� */
        }
    </style>
    <meta http-equiv="refresh" content="5">
</head>
<body>

<?php
// ��ȡ�ļ�����
$fileContent = file_get_contents('a.txt');

// ��ÿ�в�ֳ�����
$lines = explode("<br>", $fileContent);

// ������������
$lines = array_reverse($lines);

// ����ÿ��
foreach ($lines as $line) {
    // ����ÿ�е�����
    preg_match('/<strong>(.*?)<\/strong> (.*?) \((.*?)\)/', $line, $matches);

    if (count($matches) === 4) {
        // ��ȡ�û��������ݺ�ʱ��
        $username = $matches[1];
        $content = $matches[2];
        $timestamp = $matches[3];

        // ��ʾ����
        echo '<div class="content">';
        echo '<strong>' . $username . ':</strong> ' . $content . ' (' . $timestamp . ')';
        echo '<button class="copy-button" onclick="copyToClipboard(\'' . $content . '\')">';
        echo '<img src="a.png" alt="����ͼ��"> ����';
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
        alert('�Ѹ��Ƶ�������: ' + text);
    }
</script>

</body>
</html>
