// Создаёт папку и сохраняет изображение в папке img
async function createFolderAndSaveImage(folderName, imageFile) {
    const reader = new FileReader();
    const imageData = await new Promise((resolve, reject) => {
      reader.onload = () => resolve(reader.result);
      reader.onerror = reject;
      reader.readAsDataURL(imageFile);
    });

    const response = await fetch('create_folder.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        folderName: folderName,
        imageData: imageData
      })
    });
    return await response.json();
  }

  // Создаёт блок с названием и изображением
  async function createCustomServiceBlock() {
    const folderName = prompt('Введите название блока (имя папки):');
    if (!folderName) return;

    // Выбор картинки
    const inputFile = document.createElement('input');
    inputFile.type = 'file';
    inputFile.accept = 'image/*';

    inputFile.onchange = async () => {
      if (inputFile.files.length === 0) return;
      const imageFile = inputFile.files[0];

      // Создаём папку и сохраняем изображение в папке img
      const result = await createFolderAndSaveImage(folderName, imageFile);
      if (result.status !== 'success') {
        alert('Ошибка при создании папки или сохранении файла');
        return;
      }

      // Создаём блок с названием и изображением
      createServiceBlock(
        result.image, // путь к изображению в папке img
        folderName, // название блока
        'Описание', // описание по умолчанию
        null // без вызова модального окна
      );
    };

    inputFile.click();
  }

  // Функция для создания блока
  function createServiceBlock(imageSrc, title, description, modalFunctionName) {
    const container = document.querySelector('.service-grid');

    const serviceDiv = document.createElement('div');
    serviceDiv.className = 'service';

    // Добавляем изображение
    const img = document.createElement('img');
    img.src = imageSrc;
    img.alt = title;
    serviceDiv.appendChild(img);

    // Блок с содержимым
    const contentDiv = document.createElement('div');
    contentDiv.className = 'service-content';

    // Кнопка для вызова модального окна или функции
    const btn = document.createElement('button');
    btn.type = 'button';
    if (modalFunctionName) {
      btn.onclick = () => { window[modalFunctionName](); };
    }
    btn.innerHTML = `<h3>${title}</h3><p>${description}</p>`;
    contentDiv.appendChild(btn);

    serviceDiv.appendChild(contentDiv);

    // Добавляем в контейнер
    document.querySelector('.service-grid').appendChild(serviceDiv);
  }

  // Обработчик для кнопки добавления блока с названием и картинкой
  document.addEventListener('DOMContentLoaded', () => {
    const addBtn = document.createElement('button');
    addBtn.textContent = 'Добавить блок с названием и картинкой';
    addBtn.onclick = () => {
      createCustomServiceBlock();
    };
    document.querySelector('.services .container').appendChild(addBtn);
  });