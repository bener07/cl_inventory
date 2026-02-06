import API from './api';

$(document).ready(function (){
  $('#items-table').DataTable({
    ajax: function (data, callback, settings){
      API.send('/api/items', 'GET').then((data) => {
        console.log(data);
        callback({
          data: data.data,
          recordsTotal: data.recordsTotal,
          recordsFiltered: data.recordsFiltered,
          draw: data.draw
        });
      });
    },
    dataSrc: 'content',
    columns: [
      { data: 'id', name: 'id', title: 'Id'},
      {
        data: null,
        title: 'Item',
        render: function (data, type, row){
          return `<h1>${data.name}</h1><p style="font-size: small">${data.notes}</p>`;
        }
      },
      {
        data: null,
        name: 'place',
        title: 'Place',
        render: function (data, row, type){
            let places = ''
            data.place.map((place) => {
                places += `${place.number}`;
            })
            return places;
        }
      },
      { data: 'quantity', name: 'Quantity', title: 'Quantity'},
      {
        data: null,
        title: 'Introduzido Por',
        render: function (data, type, row ){
          return `${data.inputed_by.name}`;
        }
      },
      {
        data: null,
        title: 'Ações',
        orderable: false,
        render: function (data, type, row){
          return `<button class="edit-btn" data-id="${row.id}" data-item="${JSON.stringify(row)}">Edit</button>
                  <button class="delete-btn" data-id="${data.id}">Delete</button>`;
        }
      }
    ]
  });
  $('#items-table tbody').on('click', '.edit-btn',function (event){
    const id = $(event.currentTarget).data('id');
    console.log(id);
  })
  $('#items-table tbody').on('click', '.delete-btn',function (event){
    const id = $(event.currentTarget).data('id');
    if(confirm('Tem a certeza que pretende eliminar a entrada do dispositivo?')){
      API.send(`/api/items/${id}`, 'DELETE');
      $('#items-table').table.ajax.reload();
    }
  })

  $('#save-forms').on('submit', function (event){
    event.preventDefault();
    const form = this;
    const formData = new FormData(form);
    API.prettySender(form.action, form.method, formData);
    form.reset();
  });
});