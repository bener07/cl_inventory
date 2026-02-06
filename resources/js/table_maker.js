import API from './api';

export default class TablePage{
	table;
	tableName;
	customDeleteMessage;
	columns;

	constructor(table, columns, editFunction=(event) => {},customDeleteMessage=null){
		this.table = $(`#${table}-table`);
		this.tableName = table;
		this.customDeleteMessage = customDeleteMessage;
		this.columns = columns
		this.editFunction = editFunction;
	}

	setup(){
		let parent = this;
		$(document).ready(function (){
		  parent.table.DataTable({
		    ajax: function (data, callback, settings){
		      API.send(`/api/${parent.tableName}`, 'GET').then((data) => {
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
		    columns: parent.columns
		  });
		  $(`#${parent.tableName}-table tbody`).on('click', '.edit-btn',function (event){
		    const id = $(event.currentTarget).data('id');
		    parent.editFunction(event);
		  })
		  $(`#${parent.tableName}-table tbody`).on('click', '.delete-btn',function (event){
		    const id = $(event.currentTarget).data('id');
		    if(confirm(parent.customDeleteMessage ?? 'Tem a certeza que pretende eliminar a entrada?')){
		      API.send(`/api/${parent.tableName}/${id}`, 'DELETE');
		      parent.table.table.ajax.reload();
		    }
		  })
		});
	}
}