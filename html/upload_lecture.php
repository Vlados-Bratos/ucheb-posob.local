<?php
header('Content-Type: application/json');

$baseDir = '../disciplines/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $disciplineId = trim($_POST['discipline_id']);
    $lectureName = trim($_POST['lecture_name']);

    if (empty($disciplineId) || empty($lectureName)) {
        echo json_encode(['success' => false, 'message' => 'Недостаточно данных.']);
        exit;
    }

    // Создаем папку, если не существует
    $folderPath = $baseDir . $disciplineId;
    if (!is_dir($folderPath)) {
        if (!mkdir($folderPath, 0777, true)) {
            echo json_encode(['success' => false, 'message' => 'Не удалось создать папку.']);
            exit;
        }
    }

    // Обработка файла
    if (isset($_FILES['pdf_file'])) {
        $fileTmpPath = $_FILES['pdf_file']['tmp_name'];
        $fileName = basename($_FILES['pdf_file']['name']);
        $destination = $folderPath . '/' . $fileName;

        if (move_uploaded_file($fileTmpPath, $destination)) {
            $fileUrl = $destination; // или сформировать URL, если есть веб-доступ
            echo json_encode([
                'success' => true,
                'file_url' => $fileUrl,
                'lecture_name' => $lectureName
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ошибка при сохранении файла.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Файл не передан.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Некорректный метод запроса.']);
}
?>