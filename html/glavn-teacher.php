
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Дисциплины</title>
  <link rel="stylesheet" href="../style/header.css" />
  <link rel="stylesheet" href="../style/glavn.css" />
  <link rel="stylesheet" href="../style/modal-dialog.css" />
  <link rel="icon" href="../img/logo.png" />
</head>

<body>
  <header class="header">
    <img class="logo" src="../img/logo.png" alt="" />
    <div class="title">Учебное пособие Преподаватель</div>
    <div class="dropdown">
      <button class="dropbtn">
        <img src="../img/Chel.png" alt="" id="lich-cab3" />
      </button>
      <div class="dropdown-content">
        <!-- <button type="submit" name="log-account" class="dropdown-content">Выход</button> -->
        <a href="/dataBase/logOut.php">Выход</a>
        <!-- <img class="btn-toggle" id="next" src="/img/dark-them.png" alt="" /> -->
      </div>
    </div>
  </header>
  
  <section class="services">
    <div class="container">
      <h2>Дисциплины:</h2>
      <button class="dobav">Добавить предмет</button>
      <div class="service-grid" id="serviceGrid">
       
      </div>
    </div>
    </div>
  </section>

  <!-- Формы с лекциями -->

<!--  -->
 
<!--  -->
  <footer>
    <h3 class="h2-footer">ГБПОУ СРМК 2024 ©</h3>
  </footer>
<!-- Модальное окно для добавления предмета -->
<div id="modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); align-items:center; justify-content:center;">
  <div style="background:#fff; padding:20px; border-radius:10px; min-width:300px;">
    <h3>Добавить предмет</h3>
    <input type="text" id="subjectId" placeholder="ID для showModal (например, MDK_02_01)" style="width:100%; margin-bottom:10px;"><br>
    <input type="text" id="subjectTitle" placeholder="Код предмета" style="width:100%; margin-bottom:10px;"><br>
    <input type="text" id="subjectDesc" placeholder="Название предмета" style="width:100%; margin-bottom:10px;"><br>
    <input type="file" id="subjectImg" accept="image/*" style="margin-bottom:10px;"><br>
    <button id="saveSubject">Сохранить</button>
    <button id="closeModal">Отмена</button>
  </div>
</div>

<script>
const dobavBtn = document.querySelector('.dobav');
const modal = document.getElementById('modal');
const saveBtn = document.getElementById('saveSubject');
const closeModal = document.getElementById('closeModal');
const serviceGrid = document.getElementById('serviceGrid');

let lecturesData = {};
const lectures = localStorage.getItem('lecturesData');
  if (lectures) {
    lecturesData = JSON.parse(lectures);
  }
  
function loadSubjects() {
  const data = localStorage.getItem('subjects');
  if (data) {
    JSON.parse(data).forEach(addSubjectToDOM);
  }
}

function addSubjectToDOM({id, title, desc, img}) {
  const div = document.createElement('div');
  div.className = 'service';
  div.id = id;
  div.innerHTML = `
    <img src="${img}" alt="${desc}" />
    <div class="service-content">
      <button type="button" id="butto-dialog" onclick="document.getElementById('${id}_dialog').showModal()">
        <h3>${title}</h3>
        <p>${desc}</p>
      </button>
      <button class="deleteSubject" id = "delete" style="margin-top:10px;">Удалить</button>
    </div>
  `;
  // Обработка удаления
  div.querySelector('.deleteSubject').onclick = () => {
    div.remove();
    const dlg = document.getElementById(`${id}_dialog`);
    if (dlg) dlg.remove();
    delete lecturesData[id];
    saveSubjectsToStorage();
  };
  serviceGrid.appendChild(div);

  if (!document.getElementById(`${id}_dialog`)) {
    createDialogForSubject(id, title);
  }
  // Создаем диалог для этого блока
  const dialog = document.createElement('dialog');
  dialog.id = `${id}_dialog`;
  dialog.className = 'myDialog';
  dialog.innerHTML = `
    <form method="dialog">
      <button id="close" title="Закрыть">&times;</button>
    </form>
    <h2>${title}</h2>
    <!-- сюда можно вставить содержимое -->
  `;
  document.body.appendChild(dialog);
}

function saveSubjectsToStorage() {
  const subjects = [];
  document.querySelectorAll('.service').forEach(service => {
    const id = service.id;
    const title = service.querySelector('h3').textContent;
    const desc = service.querySelector('p').textContent;
    const img = service.querySelector('img').src;
    subjects.push({id, title, desc, img});
  });
  localStorage.setItem('subjects', JSON.stringify(subjects));
  localStorage.setItem('lecturesData', JSON.stringify(lecturesData))
}
function createDialogForSubject(id, title) {
  const dialog = document.createElement('dialog');
  dialog.id = `${id}_dialog`;
  dialog.className = 'myDialog';

  dialog.innerHTML = `
    <form method="dialog">
      <button type="button" class="close" title="Закрыть">&times;</button>
    </form>
    <h2>${title}</h2>
    <h3>Лекции:</h3>
    <div class="lecturesContainer"></div>
    <hr>
    <h4>Добавить лекцию:</h4>
    <form id="uploadLectureForm" style="display:flex; flex-direction:column; gap:10px;">
      <input type="text" id="lectureNameInput" placeholder="Название лекции" style="width:100%;">
      <input type="file" id="lectureFileInput" accept=".pdf" style="width:100%;">
      <button type="submit" style="padding:6px 12px;">Загрузить и добавить</button>
    </form>
  `;
  document.body.appendChild(dialog);

  // Обработчик закрытия
  dialog.querySelector('.close').onclick = () => dialog.close();

  // Обработчик формы загрузки
  const uploadForm = dialog.querySelector('#uploadLectureForm');
  uploadForm.onsubmit = (e) => {
    e.preventDefault();
    const lectureName = dialog.querySelector('#lectureNameInput').value.trim();
    const fileInput = dialog.querySelector('#lectureFileInput');
    const file = fileInput.files[0];

    if (!file) {
      alert('Выберите PDF файл.');
      return;
    }
    // Создаем FormData для AJAX-запроса
    const formData = new FormData();
    formData.append('discipline_id', id);
    formData.append('lecture_name', lectureName || file.name.replace(/\.[^/.]+$/, ""));
    formData.append('pdf_file', file);

    // Отправляем на сервер
    fetch('upload_lecture.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Добавляем кнопку с ссылкой на файл
        if (!lecturesData[id]) lecturesData[id] = [];
        lecturesData[id].push({name: data.lecture_name, url: data.file_url});
        renderLectures(id);
        saveSubjectsToStorage();
        // Очистка формы
        dialog.querySelector('#lectureNameInput').value = '';
        dialog.querySelector('#lectureFileInput').value = '';
      } else {
        alert('Ошибка загрузки файла: ' + data.message);
      }
    })
    .catch(() => alert('Ошибка при отправке файла.'));
  };

  // Отрисовать текущие лекции
  renderLectures(id);
}

function renderLectures(id) {
  const dialog = document.getElementById(`${id}_dialog`);
  if (!dialog) return;
  const lecturesContainer = dialog.querySelector('.lecturesContainer');
  lecturesContainer.innerHTML = '';
  if (!lecturesData[id]) lecturesData[id] = [];
  lecturesData[id].forEach((lecture, idx) => {
    const div = document.createElement('div');
    div.className = 'lecture-row';
    div.style.display = 'flex';
    div.style.alignItems = 'center';
    div.style.marginBottom = '5px';

    // Создаем кнопку с ссылкой
    const linkBtnHTML = `
      <a href="${lecture.url}" target="_blank" style="text-decoration:none;">
        <button class="btn-present">${lecture.name}</button>
      </a>
    `;
    div.innerHTML = linkBtnHTML;

    // Кнопка удаления
    const delBtn = document.createElement('button');
    delBtn.textContent = 'Удалить';
    delBtn.className = 'delete-lecture-btn';
    delBtn.onclick = () => {
      // Удаляем из данных
      lecturesData[id].splice(idx, 1);
      // Перерисовываем
      renderLectures(id);
      saveSubjectsToStorage();
    };
    div.appendChild(delBtn);

    lecturesContainer.appendChild(div);
  });
}
dobavBtn.onclick = () => {
  modal.style.display = 'flex';
};

closeModal.onclick = () => {
  modal.style.display = 'none';
};

saveBtn.onclick = () => {
  const id = document.getElementById('subjectId').value.trim();
  const title = document.getElementById('subjectTitle').value.trim();
  const desc = document.getElementById('subjectDesc').value.trim();
  const imgInput = document.getElementById('subjectImg');
  if (!id || !title || !desc || !imgInput.files[0]) {
    alert('Заполните все поля и выберите картинку!');
    return;
  }
  if (!/^[A-Za-z_][A-Za-z0-9_]*$/.test(id)) {
    alert('ID должен начинаться с буквы или _, содержать только буквы, цифры и _');
    return;
  }
  const reader = new FileReader();
  reader.onload = function(e) {
    const img = e.target.result;
    addSubjectToDOM({id, title, desc, img});
    saveSubjectsToStorage();
    modal.style.display = 'none';
    document.getElementById('subjectId').value = '';
    document.getElementById('subjectTitle').value = '';
    document.getElementById('subjectDesc').value = '';
    imgInput.value = '';
  };
  reader.readAsDataURL(imgInput.files[0]);
};

window.onload = () => {
  loadSubjects();
};
</script>
 

  
</body>
</html>
