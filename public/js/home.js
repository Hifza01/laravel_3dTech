document.getElementById('addItemForm').addEventListener('submit', function(event) {
  event.preventDefault();

  // Ambil data dari form
  const title = document.getElementById('itemTitle').value;
  const column = document.getElementById('itemColumn').value;

  // Logika untuk menambahkan item ke kolom yang sesuai
  // Misalnya dengan menambahkan elemen HTML ke dalam kolom yang dipilih
  const columnMap = {
      'todo': '.kanban-column:nth-child(1) .kanban-body',
      'in_progress': '.kanban-column:nth-child(2) .kanban-body',
      'done': '.kanban-column:nth-child(3) .kanban-body',
      'backlog': '.kanban-column:nth-child(4) .kanban-body'
  };

  const columnBody = document.querySelector(columnMap[column]);
  const newItem = document.createElement('div');
  newItem.classList.add('kanban-item');
  newItem.textContent = title;
  columnBody.appendChild(newItem);

  // Tutup modal dan reset form
  $('#addItemModal').modal('hide');
  document.getElementById('addItemForm').reset();
});